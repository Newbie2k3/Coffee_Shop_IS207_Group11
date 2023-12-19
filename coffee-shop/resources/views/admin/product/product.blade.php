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

    <div class="container-fluid px-5 py-4">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-4 text-gray-900">
                <table id="myTable" class="display" style="width:100%;">
                    <thead>
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Mô tả sản phẩm</th>
                            <th scope="col">Danh mục sản phẩm</th>
                            <th scope="col">Tình trạng</th>
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

    <script>
        const csrfToken = "{{ csrf_token() }}";
        const itemDeleteUrl = "{{ route('product_destroy', [':id']) }}";
    </script>
</x-admin-layout>
