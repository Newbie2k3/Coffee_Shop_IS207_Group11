<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(){
        $category = DB::table('products')
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->select('products.*', 'categories.name as category_name')
        ->get();
        $product = Product::with('category')->get();
        return view('product',compact('product'));
    }
    public function create(){
        $category = Category::orderBy('id','desc')->get();
        return view('product_create',compact('category'));
    }

    public function store(Request $request){
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/img/product'), $filename);
            Product::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'category_id' => $request->input('category_id'),
                'status' => $request->input('status'),
                'price' => $request->input('price'),
                'image' => $filename,
            ]);
        }
        $category_name = Category::find($request->input('category_id'))->name;
    
        return redirect()->route('product')->with('category_name', $category_name);;
    }

    public function edit($id){
        $product= Product::find($id);
        $category = Category::orderBy('id','desc')->get();
        return view('product_edit',compact('product'))->with('category',$category);
    }

    public function update(Request $request, $id){
        $product= Product::find($id);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/img/product'), $filename);
            $product->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'category_id' => $request->input('category_id'),
                'status' => $request->input('status'),
                'price' => $request->input('price'),
                'image' => $filename,
            ]);
        }
        return redirect()->route('product');
    }

    public function destroy($id){
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('product');
    }
}
