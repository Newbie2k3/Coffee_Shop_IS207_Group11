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
                    {{ __("Thông tin Sản phẩm") }}
                    <h2 style="color:black">Tìm kiếm sản phẩm</h2>
                    <form action="{{ route('product_search') }}" method="GET">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Tìm kiếm sản phẩm" name="search" >
                            <div class="input-group-append">
                                <x-primary-button>Tìm</x-primary-button>
                            </div>
                        </div>
                    </form>
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Mô tả sản phẩm</th>
                            <th scope="col">Danh mục sản phẩm</th>
                            <th scope="col">Hiển thị</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col" colspan="2">
                                Thao tác
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                            @if(isset($keyword))
                                <p>Search results for '{{ $keyword }}':</p>
                            @endif
                        @foreach ($product as $item)
                          <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->description }}</td>
                            <td>{{ $item->category->name }}</td>
                            <td>
                                <?php
                                if($item->status=='0'){
                                    echo "Ẩn";
                                }else{
                                    echo "Hiện";
                                }
                                ?>
                            </td>
                            <td>{{ $item->price }}đ</td>
                            <td><img src="{{ asset('assets/img/product/'.$item->image) }}" alt="{{ $item->image }}"width=100 height=100></td>
                            <td>
                                <form action="{{ route('product_destroy',$item->id) }}" method="POST">
                                    <a href="{{ route('product_edit',$item->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Sửa</a>
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button >Xóa</x-danger-button>
                                </form>
                            </td>
                          </tr>
                        @endforeach
                        </tbody>
                      </table>    
                      <a href="{{ route('product_create') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">Thêm sản phẩm mới</a>                
                </div>
                {{ $product->links() }}
            </div>
        </div>
    </div>
</x-admin-layout>