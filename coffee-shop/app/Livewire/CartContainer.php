<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

use Gloudemans\Shoppingcart\Facades\Cart;

class CartContainer extends Component
{
    #[On('cart_updated')]
    public function render()
    {
        $cart_items = Cart::content();
        // dd($cart_items);

        return view('livewire.cart-container', compact('cart_items'));
    }
}
