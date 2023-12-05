<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function show(Request $request)
    {
        $category = DB::table('products')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->select('products.*', 'categories.name as category_name')
            ->get();
        $categories = DB::table('categories')->get();
        $keyword = $request->input('search');
        $product = Product::where('name', 'like', '%' . $keyword . '%')->paginate(5);
        return view('admin.product.product', compact('product', 'category', 'categories', 'keyword'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function getProducts($category_id)
    {
        $products = Product::where('category_id', $category_id)->get();
        return view('admin.product.product_list', compact('products'));
    }

    public function create()
    {
        $category = Category::orderBy('id', 'desc')->get();
        return view('admin.product.product_create', compact('category'));
    }

    public function store(Request $request)
    {
        print_r($request->all());
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'product_' . $request->input('category_id') . '_' . time() . '.' . $file->getClientOriginalExtension();
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

        return redirect()->route('product')->with('category_name', $category_name);
        ;
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $category = Category::orderBy('id', 'desc')->get();
        return view('admin.product.product_edit', compact('product'))->with('category', $category);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $image_path=public_path('assets/img/product/'. $product->image);
        if($request->hasFile('image')){
            File::delete($image_path);
        }
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'product_' . $request->input('category_id') . '_' . time() . '.' . $file->getClientOriginalExtension();
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

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $image_path=public_path('assets/img/product/'. $product->image);
        // echo $image_path;
        if(File::exists($image_path)){
            File::delete($image_path);
        }
        $product->delete();
        return redirect()->route('product');
    }
    //end admin function

    public function product_detail($id)
    {
        $product = Product::where('id', $id)->first();
        $related_product = Product::where('category_id', $product->category_id)->where('id', '<>', $id)->limit(4)->get();
        return view('pages.menu.product_detail', compact('product', 'related_product'));
    }
}
