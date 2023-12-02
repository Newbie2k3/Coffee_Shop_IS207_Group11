<x-admin-layout>
    @section('title', 'Product')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Chỉnh sửa danh mục sản phẩm") }}
                    <form action="{{ route('product_update',$product->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên sản phẩm</label>
                            <input type="text" name='name' value="{{ $product->name }}" class="form-control" placeholder="Nhập tên sản phẩm" >
                          </div>
                          <div class="mb-3">
                              <label for="price" class="form-label">Giá sản phẩm</label>
                              <input type="text" name='price' value="{{ $product->price }}" class="form-control" placeholder="Nhập giá sản phẩm" >
                          </div>
                          <div class="mb-3">
                              <label for="category_id" class="form-label">Danh mục sản phẩm</label>
                              <select name="category_id">
                                  @foreach ($category as $item)
                                      <option value="{{ $item->id }}" {{ $item->id == old('category_id', $product->category_id) ? 'selected' : '' }}>{{ $item->name }}</option>
                                  @endforeach
                              </select>
                          </div>
                          <div class="mb-3">
                              <label for="description" class="form-label">Mô tả sản phẩm</label>
                              <textarea type="text" rows="8" name='description' class="form-control" placeholder="Nhập mô tả">{{ $product->description }}</textarea>
                          </div>
                          <div class="mb-3">
                              <label for="status" class="form-label">Hiển thị</label>
                              <select name="status">
                                  <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Ẩn</option>
                                  <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Hiện</option>
                              </select>
                          </div>
                          <div class="mb-3">
                              <label for="image" class="form-label">Hình ảnh sản phẩm</label>
                              <input type="file" name='image' value="{{ $product->image }}" class="form-control" >
                          </div>
                          <x-primary-button>Lưu</x-primary-button>
                      </form>                
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>