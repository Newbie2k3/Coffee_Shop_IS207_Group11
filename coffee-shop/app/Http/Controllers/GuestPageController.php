<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Http;

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
                ->whereIn('status', [0, 1])
                ->get();

            $menu[] = [
                'id' => $category->id,
                'name' => $category->name,
                'description' => $category->description,
                'products' => $products->toArray(),
            ];
        }

        return view('pages.menu.index', compact('menu'))->with('title', $title);
    }

    public function about()
    {
        $title = "About us";
        $product = Product::get();
        return view('pages.about.index', compact('product'))->with('title', $title);
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

    public function submit_form(Request $request)
    {
        $data = $request->all();
        $response = http::post(config('lark.webhook'), $data);

        if ($response->successful()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
