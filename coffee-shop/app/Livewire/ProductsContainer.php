<?php

namespace App\Livewire;

use Livewire\Component;

use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Category;
use App\Models\Product;

class ProductsContainer extends Component
{
    public array $quantity = [];
    public $categories = [];
    public $menu = [];

    public function mount()
    {
        $this->categories = Category::all();
        foreach ($this->categories as $category) {
            $products = Product::where('category_id', $category->id)
                ->where('status', 1)
                ->get();

            foreach ($products as $product) {
                $this->quantity[$product->id] = 1;
            }

            $this->menu[] = [
                'id' => $category->id,
                'name' => $category->name,
                'products' => $products->toArray(),
            ];
        }
    }

    public function render()
    {
        $cart = Cart::content();

        return view('livewire.products-container', compact('cart'));
    }

    public function addToCart($product_id)
    {
        $product = Product::findOrFail($product_id);
        
        Cart::add(
            $product->id,
            $product->name,
            $this->quantity[$product_id],
            $product->price,
        );

        $this->dispatch('cart_updated');
    }
}
