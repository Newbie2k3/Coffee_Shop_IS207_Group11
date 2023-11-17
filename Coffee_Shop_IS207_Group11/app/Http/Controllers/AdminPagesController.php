<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminPagesController extends Controller
{
    public function index()
    {
        $title = "Admin";
        return view('pages.admin.index')->with('title', $title);
    }
}
