<?php

namespace App\Livewire;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Livewire\Attributes\On; 

class CartCounter extends Component
{
    #[On('cart_updated')] 
    public function render()
    {
        $cart_count = Cart::content()->count();

        return view('livewire.cart-counter', compact('cart_count'));
    }
}
