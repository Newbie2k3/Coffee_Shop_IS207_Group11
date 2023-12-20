<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Exports\PaymentExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Payment;
use App\Models\PaymentDetail;
use App\Models\Cart;
use Stripe\Stripe;
use Stripe\StripeClient;
use Stripe\Webhook;
use Stripe\Exception\SignatureVerificationException;

class PaymentController extends Controller
{
    public function session(Request $request)
    {
        $cartItems = [];

        Stripe::setApiKey(config('stripe.sk'));
        $user = auth()->user();
        $cart_items = Cart::with('product')->where('user_id', $user->id)->get();

        foreach ($cart_items as $cartItem) {
            $product_name = $cartItem->product->name;
            $price = $cartItem->product->price;
            $quantity = $cartItem->product_qty;

            $total = $price * $quantity;

            $unit_amount = "$total";

            $cartItems[] = [
                'price_data' => [
                    'product_data' => [
                        'name' => $product_name,
                    ],
                    'currency' => 'VND',
                    'unit_amount' => $price,
                ],
                'quantity' => $quantity
            ];
        }

        $checkoutSession = \Stripe\Checkout\Session::create([
            'line_items' => [$cartItems],
            'mode' => 'payment',
            'allow_promotion_codes' => true,
            'metadata' => [
                'user_id' => $user->id,
            ],
            'customer_email' => $user->email,
            'success_url' => route('checkout.success'),
            'cancel_url' => route('cart'),
        ]);

        return redirect()->away($checkoutSession->url);
    }

    public function getData(Request $request)
    {
        $stripe = new StripeClient(config('stripe.sk'));
        $endpoint_secret = config('stripe.ep');

        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $event = null;

        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $endpoint_secret);
        } catch (SignatureVerificationException $e) {
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        // Handle the event
        switch ($event->type) {
            case 'payment_intent.created':
                $data = $event->data->object;
                break;
            case 'payment_intent.succeeded':
                $data = $event->data->object;
                break;
            case 'charge.succeeded':
                $data = $event->data->object;
                break;
            case 'checkout.session.completed':
                $data = $event->data->object;
                $this->store($data);
                break;
            default:
                return response()->json(['error' => 'Received unknown event type ' . $event->type], 400);
        }

        return response()->json(['success' => true]);
    }

    public function success()
    {
        return view('pages.checkout.success');
    }

    public function cancel()
    {
        return view('pages.checkout.cancel');
    }

    public function personalInvoices()
    {
        $user = auth()->user();
        $invoices = $user->payments()->where('status', 'paid')->with('payment_details.product')->get();
        return view('pages.profile.payment-history', compact('invoices'));
    }
    public function allInvoices()
    {
        $invoices = Payment::where('status', 'paid')->with('user', 'payment_details.product')->get();
        return view('admin.payment-history', compact('invoices'));
    }

    public function export()
    {
        $timestamp = now()->format('Y-m-d_H-i-s');
        return Excel::download(new PaymentExport, 'payment_history_' . $timestamp . '.xlsx');
    }

    protected function store($data)
    {
        $user = User::find($data->metadata->user_id);
        $cart_items = Cart::with('product')->where('user_id', $user->id)->get();

        $payment = Payment::create([
            'user_id' => $user->id,
            'email' => $user->email,
            'amount' => $data->amount_total,
            'currency' => $data->currency,
            'payment_method' => $data->payment_method_types[0],
            'status' => $data->payment_status,
        ]);

        if ($data->payment_status == 'paid') {
            foreach ($cart_items as $cartItem) {
                $product_id = $cartItem->product_id;
                $quantity = $cartItem->product_qty;

                PaymentDetail::create([
                    'payment_id' => $payment->id,
                    'product_id' => $product_id,
                    'quantity' => $quantity,
                ]);
            }

            Cart::where('user_id', $user->id)->delete();
        }
    }
}
