<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function view()
    {
        $title = "Cart";
        return view('pages.cart.index')->with('title', $title);
    }

    public function addToCart(Request $request)
    {
        $data = $request->all();
        print_r($data);
    }
}
