<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Cart;
use App\Models\CartProduct;

class CartController extends Controller
{
    public function view()
    {
        $title = "Cart";

        $user = auth()->user();
        $cart = Cart::where('user_id', $user->id)->first();
        if (!$cart) {
            $cart = Cart::create([
                'user_id' => $user->id,
            ]);
        }
        $cart_items = CartProduct::with('product')->where('cart_id', $cart->id)->get();
        $cart_total = $this->calculateCartTotal();

        return view('pages.cart.index', compact('cart_items', 'cart_total',))->with('title', $title);
    }

    public function addToCart(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['status' => 'Login to continue!']);
        }
        $product_id = (int)$request->input('product_id');
        $findProduct = Product::find($product_id);
        if (!$findProduct) {
            return response()->json(['message' => 'Invalid product!', 'status' => 'error']);
        }
        if ($findProduct->quantity < (int)$request->input('product_qty')) {
            return response()->json(['message' => 'Out of stock!', 'status' => 'error']);
        }

        $cart = Cart::where('user_id', $user->id)->first();
        if (!$cart) {
            $cart = Cart::create([
                'user_id' => $user->id,
            ]);
        }
        $cart_item = CartProduct::with('product')->where('cart_id', $cart->id)->where('product_id', $product_id)->first();
        if (!$cart_item) {
            $cart_item = CartProduct::create([
                'cart_id' => $cart->id,
                'product_id' => $product_id,
                'quantity' => (int)$request->input('product_qty'),
                'total' => $findProduct->price * (int)$request->input('product_qty'),
            ]);
        } else {
            $cart_item->quantity = $cart_item->quantity + $request->input('product_qty');
            $cart_item->total = $cart_item->quantity * $findProduct->price;
            $cart_item->save();
        }
        $cart->total_cart = $this->calculateCartTotal();
        $cart->save();

        return response()->json(['findProduct' => $findProduct, 'cart_item' => $cart_item, 'status' => $findProduct->name . ' added to cart', 'cartTotal' => $this->calculateCartTotal(),]);
    }

    public function getCartCount()
    {
        $user = auth()->user();

        $cart = Cart::where('user_id', $user->id)->first();
        $cart_count = CartProduct::where('cart_id', $cart->id)->count();
        return response()->json(['cartCount' => $cart_count]);
    }

    public function getCart()
    {
        $user = auth()->user();

        $cart = Cart::where('user_id', $user->id)->first();
        $cart_items = CartProduct::with('product')->where('cart_id', $cart->id)->get();
        $cart_total = $this->calculateCartTotal();
        return response()->json(['cartItems' => $cart_items, 'cartTotal' => 'cart_total']);
    }

    public function removeItem(Request $request)
    {
        $id = $request->input('cart_product_id');
        $cart_item = CartProduct::find($id);
        if (!$cart_item) {
            return response()->json(['message' => 'Item không tồn tại trong gio hang'], 404);
        }
        $removedItem = Cart::find($id);

        if (!$removedItem) {
            return response()->json(['message' => 'Giỏ không tồn tại'], 404);
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
        $cart = Cart::where('user_id', $user->id)->first();
        $cart_items = CartProduct::with('product')->where('cart_id', $cart->id)->get();

        $total = 0;

        foreach ($cart_items as $cart_item) {
            $total += $cart_item->product->price * $cart_item->quantity;
        }

        return $total;
    }

    private function calculateItemTotal($product, $quantity)
    {
        return $product->price * $quantity;
    }
}
