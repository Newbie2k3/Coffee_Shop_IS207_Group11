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
        $cart_items = Cart::with('product')
            ->where('user_id', $user->id)
            ->where('is_deleted', 0)
            ->get();

        $product_ids = $cart_items->pluck('product_id');
        $products = Product::whereIn('id', $product_ids)->get();

        $cart_total = $this->calculateCartTotal();

        return view('pages.cart.index', compact('cart_items', 'products', 'cart_total',))->with('title', $title);
    }

    public function addToCart(Request $request)
    {
        $user = Auth::user();

        $product_id = $request->input('product_id');
        $product_qty = max(1, $request->input('product_qty'));

        $product = Product::find($product_id);

        if (!$user) {
            return response()->json(['status' => 'Login to continue!']);
        }

        if (!$product) {
            return response()->json(['status' => 'Invalid product!']);
        }

        $existingCartItem = Cart::where('product_id', $product_id)
            ->where('user_id', $user->id)
            ->first();

        if ($existingCartItem) {
            return response()->json(['status' => $product->name . ' already added to cart']);
        }

        Cart::create([
            'user_id' => $user->id,
            'product_id' => $product_id,
            'product_qty' => $product_qty,
        ]);

        return response()->json(['status' => $product->name . ' added to cart', 'cartTotal' => $this->calculateCartTotal(),]);
    }

    public function getCartCount()
    {
        $cart_count = Cart::where('user_id', auth()->id())->count();
        return response()->json(['cartCount' => $cart_count]);
    }

    public function getCart()
    {
        $user = auth()->user();
        $cart_items = Cart::with('product')->where('user_id', $user->id)->get();

        $product_ids = $cart_items->pluck('product_id');
        $products = Product::whereIn('id', $product_ids)->get();

        return response()->json(['cartItems' => $cart_items, 'products' => $products, 'cartTotal' => $this->calculateCartTotal(),]);
    }

    public function removeItem(Request $request)
    {
        $id = $request->input('id');

        $removedItem = Cart::find($id);

        if (!$removedItem) {
            return response()->json(['message' => 'Sản phẩm không tồn tại'], 404);
        }

        $removedItem->delete();

        return response()->json(['removedItem' => $removedItem, 'cartTotal' => $this->calculateCartTotal(),]);
    }

    public function updateQuantity(Request $request)
    {
        $id = $request->input('id');
        $newQuantity = max(1, $request->input('new_quantity'));

        $cartItem = Cart::find($id);

        if (!$cartItem) {
            return response()->json(['message' => 'Sản phẩm không tồn tại'], 404);
        }

        $cartItem->update(['product_qty' => $newQuantity]);

        $itemTotal = $this->calculateItemTotal($cartItem->product, $newQuantity);

        return response()->json([
            'updatedItem' => $cartItem,
            'itemTotal' => $itemTotal,
            'cartTotal' => $this->calculateCartTotal(),
        ]);
    }

    // Private
    private function calculateCartTotal()
    {
        $user = auth()->user();
        $cart_items = Cart::with('product')->where('user_id', $user->id)->get();

        $total = 0;

        foreach ($cart_items as $cart_item) {
            $total += $cart_item->product->price * $cart_item->product_qty;
        }

        return $total;
    }

    private function calculateItemTotal($product, $quantity)
    {
        return $product->price * $quantity;
    }
}
