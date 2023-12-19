<?php

namespace App\Http\Controllers;

use App\Models\Category;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show()
    {
        $category = Category::all();
        return view('admin.category.category', compact('category'));
    }
    public function create()
    {
        return view('admin.category.category_create');
    }

    public function store(Request $request)
    {
        Category::create($request->all());
        return redirect()->route('category');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.category_edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->update($request->all());
        return redirect()->route('category');
    }

    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);

            if ($category) {
                $category->delete();

                $remainingCategories = Category::count();

                return response()->json(['message' => 'Danh mục đã được xóa thành công.', 'remaining' => $remainingCategories], 200);
            } else {
                return response()->json(['message' => 'Danh mục không tồn tại.'], 404);
            }
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];

            if ($errorCode == 1451) {
                return response()->json(['message' => 'Không thể xóa danh mục vì có dữ liệu liên quan.'], 500);
            }

            return response()->json(['message' => 'Lỗi xóa danh mục: ' . $e->getMessage()], 500);
        }
    }
}
