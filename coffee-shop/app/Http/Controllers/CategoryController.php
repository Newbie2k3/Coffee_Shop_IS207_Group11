<?php

namespace App\Http\Controllers;

use App\Models\Category;


use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(){
        $category = Category::all();
        return view('admin.category.category',compact('category'));
    }
    public function create(){
        return view('admin.category.category_create');
    }
    
    public function store(Request $request){
        Category::create($request->all());
        return redirect()->route('category');
    }

    public function edit($id){
        $category= Category::find($id);
        return view('admin.category.category_edit',compact('category'));
    }

    public function update(Request $request, $id){
        $category= Category::find($id);
        $category->update($request->all());
        return redirect()->route('category');
    }

    public function destroy($id){
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('category');
    }
}
