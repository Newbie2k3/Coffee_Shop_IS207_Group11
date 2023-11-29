<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Product;

class GuestPageController extends Controller
{
    public function index()
    {
        $title = "Home";
        return view('pages.home.index')->with('title', $title);
    }

    public function greatDeals()
    {
        $title = "Greats deals";
        return view('pages.great-deals.index')->with('title', $title);
    }

    public function menu()
    {
        $title = "Menu";
        
        $categories = Category::all();

        $menu = [];
    
        foreach ($categories as $category) {
            $products = Product::where('category_id', $category->id)
                              ->where('status', 1)
                              ->get();
    
            $menu[] = [
                'id' => $category->id,
                'name' => $category->name,
                'products' => $products->toArray(),
            ];
        }

        return view('pages.menu.index', compact('menu'))->with('title', $title);
    }

    public function about()
    {
        $title = "About us";
        return view('pages.about.index')->with('title', $title);
    }
    public function account()
    {
        $title = "Account";
        return view('pages.account.index')->with('title', $title);
    }

    public function cart()
    {
        $title = "Cart";
        return view('pages.cart.index')->with('title', $title);
    }
}
