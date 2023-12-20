<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function show(Request $request)
    {
        $products = Product::with('category')->get();
        $categories = Category::all();

        return view('admin.product.product', compact('products', 'categories'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $categoryId = $request->input('categoryId');

        $query = Product::with('category')
            ->where('name', 'like', "%$keyword%");

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        $products = $query->get();
        $categories = Category::all();

        return view('admin.product.product_list', compact('products', 'keyword', 'categoryId'))->render();
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
        $this->validateProductRequest($request);

        $filename = $this->uploadFile($request);

        Product::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category_id'),
            'status' => $request->input('status'),
            'price' => $request->input('price'),
            'image' => $filename,
        ]);

        $category_name = Category::find($request->input('category_id'))->name;

        return redirect()->route('product')->with('category_name', $category_name);
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $category = Category::orderBy('id', 'desc')->get();
        return view('admin.product.product_edit', compact('product'))->with('category', $category);
    }

    public function update(Request $request, $id)
    {
        $this->validateProductRequest($request);

        $product = Product::findOrFail($id);

        $filename = $this->uploadFile($request, $product);

        $product->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category_id'),
            'status' => $request->input('status'),
            'price' => $request->input('price'),
            'image' => $filename ?: $product->image,
        ]);

        return redirect()->route('product');
    }

    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);

            if (!$product) {
                return response()->json(['message' => 'Sản phẩm không tồn tại.'], 404);
            }

            $this->deleteFile($product);
            $product->delete();

            $remainingProducts = Product::count();

            return response()->json(['message' => 'Sản phẩm đã được xóa thành công.', 'remaining' => $remainingProducts], 200);
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];

            if ($errorCode == 1451) {
                return response()->json(['message' => 'Không thể xóa vì có dữ liệu liên quan.'], 500);
            }

            return response()->json(['message' => 'Lỗi xóa sản phẩm: ' . $e->getMessage()], 500);
        }
    }
    //end admin function

    // Private
    private function validateProductRequest(Request $request)
    {
        $rules = [
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        $request->validate($rules);
    }

    private function uploadFile(Request $request, $existingProduct = null)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'product_' . $request->input('category_id') . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/img/product'), $filename);

            if ($existingProduct) {
                $this->deleteFile($existingProduct);
            }

            return $filename;
        }

        return null;
    }

    private function deleteFile(Product $product)
    {
        $imagePath = public_path('assets/img/product/' . $product->image);

        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }
    }

    // Detail gonna muv into guest
    public function product_detail($id)
    {
        $product = Product::where('id', $id)->first();
        $related_product = Product::where('category_id', $product->category_id)->where('id', '<>', $id)->limit(4)->get();
        return view('pages.menu.product_detail', compact('product', 'related_product'));
    }
}
