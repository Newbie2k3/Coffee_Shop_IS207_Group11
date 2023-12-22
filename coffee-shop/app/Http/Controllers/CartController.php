<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Cart;

class CartController extends Controller
{
    public function view()
    {
        $title = "Cart";

        $user = auth()->user();
        $cart_items = Cart::with('product')->where('user_id', $user->id)->get();
        $cart_total = $this->calculateCartTotal($cart_items);

        return view('pages.cart.index', compact('cart_items', 'cart_total'))->with('title', $title);
    }

    public function addToCart(Request $request)
    {
        $product_id = $request->input('product_id');
        $product_qty = max(1, $request->input('product_qty'));

        $user = Auth::user();
        $product = Product::find($product_id);

        if (!$user || !$product || $product->status != 1) {
            return response()->json(['status' => 'warning']);
        }

        if (!$product->hasEnoughQuantity($product_qty)) {
            return response()->json(['status' => 'not_enough', 'message' => $product->quantity]);
        }

        $existing_item = Cart::where('product_id', $product_id)
            ->where('user_id', $user->id)
            ->first();

        if ($existing_item) {
            $new_quantity = $existing_item->product_qty + $product_qty;

            if (!$product->hasEnoughQuantity($new_quantity)) {
                return response()->json(['status' => 'not_enough', 'message' => $product->quantity]);
            }

            $existing_item->update(['product_qty' => $new_quantity]);
        } else {
            Cart::create([
                'user_id' => $user->id,
                'product_id' => $product_id,
                'product_qty' => $product_qty,
            ]);
        }

        return response()->json(['status' => $product->name . ' đã được thêm vào giỏ hàng.', 'cartTotal' => $this->calculateCartTotal(),]);
    }

    public function getCartCount()
    {
        $cart_count = Cart::where('user_id', auth()->id())->count();
        return response()->json(['cart_count' => $cart_count]);
    }

    public function getCart()
    {
        $user = auth()->user();
        $cart_items = Cart::with('product')->where('user_id', $user->id)->get();
        $cart_total = $this->calculateCartTotal($cart_items);

        return response()->json(['cart_items' => $cart_items, 'cart_total' => $cart_total]);
    }

    public function removeFromCart(Request $request)
    {
        $id = $request->input('id');

        $removed_item = Cart::find($id);

        if (!$removed_item) {
            return response()->json(['message' => 'Sản phẩm không tồn tại'], 404);
        }

        $removed_item->delete();

        return response()->json(['removed_item' => $removed_item, 'cart_total' => $this->calculateCartTotal(),]);
    }

    public function updateItemQty(Request $request)
    {
        $id = $request->input('id');
        $product_qty = max(1, $request->input('product_qty'));

        $cart_item = Cart::find($id);
        $product = Product::find($cart_item->product_id);

        if (!$product->hasEnoughQuantity($product_qty)) {
            return response()->json(['status' => 'warning', 'message' => 'Sản phẩm không đủ số lượng. Chỉ còn: ' . $product->quantity], 400);
        }

        if (!$cart_item) {
            return response()->json(['status' => 'warning', 'message' => 'Sản phẩm không tồn tại'], 404);
        }

        $cart_item->update(['product_qty' => $product_qty]);

        return response()->json([
            'status' => 'success',
            'item_total' => $this->calculateItemTotal($cart_item->product, $product_qty),
            'cart_total' => $this->calculateCartTotal(),
        ]);
    }

    // Private
    private function calculateCartTotal($cart_items = null)
    {
        if (!$cart_items) {
            $user = auth()->user();
            $cart_items = Cart::with('product')->where('user_id', $user->id)->get();
        }

        return $cart_items->sum(function ($cart_item) {
            return $cart_item->product->price * $cart_item->product_qty;
        });
    }

    private function calculateItemTotal($product, $quantity)
    {
        return $product->price * $quantity;
    }
}
