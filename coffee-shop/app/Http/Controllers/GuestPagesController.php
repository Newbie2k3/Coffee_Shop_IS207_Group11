<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class GuestPagesController extends Controller
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
        $product = DB::table('products')->where('status','1')->get();
        return view('pages.menu.index',compact('product'))->with('title', $title);
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
