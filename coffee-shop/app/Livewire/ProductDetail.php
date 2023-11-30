<?php

namespace App\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use App\Models\Product;

class ProductDetail extends Component
{
    public $product;
    public $quantity = 1;

    public function mount($id)
    {
        $this->product = Product::findOrFail($id);
    }
    public function render()
    {
        $cart = Cart::content();

        return view('livewire.product-detail', compact('cart'));
    }

    public function addToCart($product_id)
    {
        $product = Product::findOrFail($product_id);
        
        Cart::add(
            $product->id,
            $product->name,
            $this->quantity,
            $product->price,
        );

        $this->dispatch('cart_updated');
    }
}
