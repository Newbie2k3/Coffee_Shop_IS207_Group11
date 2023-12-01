<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Product;

class CartController extends Controller
{
    public function view()
    {
        $title = "Cart";
        return view('pages.cart.index')->with('title', $title);
    }

    public function addToCart(Request $request)
    {
        $data = $request->input('product_id');
        if (Auth::check()) {
            print_r($data . 'Login rui');
        } else {
            print_r($data . 'Chua login');
        }
    }
}
