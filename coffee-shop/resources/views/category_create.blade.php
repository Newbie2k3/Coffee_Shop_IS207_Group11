<x-admin-layout>
    @section('title', 'Category')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Thêm danh mục sản phẩm") }}
                    <form action="{{ route('category_store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Tên danh mục</label>
                          <input type="text" name='name' class="form-control" placeholder="Nhập tên danh mục" >
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Mô tả danh mục</label>
                            <textarea type="text" rows="8" name='description' class="form-control" placeholder="Nhập mô tả"></textarea>
                        </div>
                        <x-primary-button>Lưu</x-primary-button>
                      </form>                   
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>