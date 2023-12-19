<x-admin-layout>
    @section('title', 'Product')

    <x-slot name="header">
        <div class="position-relative">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Product') }}
            </h2>

            <a href="{{ route('product_create') }}"
                class="btn btn-primary position-absolute translate-middle top-3 end-0">Thêm
                sản phẩm</a>
        </div>
    </x-slot>

    {{-- <div class="container-fluid pt-4 px-5 d-flex justify-content-end">
        <div class="input-group mb-2" style="max-width: 500px;">
            <input id="search-input" type="text" class="form-control" placeholder="Tìm kiếm sản phẩm" name="search">
            <select id="category" name="category_id" class="form-select" style="max-width: 140px;">
                <option value="">Tất cả</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <button class="btn btn-primary" type="button" id="search-btn">Tìm</button>
        </div>
    </div> --}}

    <div class="container-fluid px-5 py-4">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-4 text-gray-900">
                {{-- <table class="table table-hover"> --}}
                <table id="myTable" class="display" style="width:100%;">
                    <thead>
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Mô tả sản phẩm</th>
                            <th scope="col">Danh mục sản phẩm</th>
                            <th scope="col">Hiển thị</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">
                                Thao tác
                            </th>
                        </tr>
                    </thead>
                    <tbody id="product-list">
                        @include('admin.product.product_list', [
                            'products' => $products,
                            'keywork' => null,
                            'categoryId' => null,
                        ])
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>
