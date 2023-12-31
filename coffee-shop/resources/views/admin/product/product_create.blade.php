<x-admin-layout>
    @section('title', 'Product')
    @php
        $categoryOptions = $category->mapWithKeys(function ($item) {
            return [$item->id => $item->name];
        });
    @endphp

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('product') }}">{{ __('Product') }}</a>/{{ __('Thêm') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('product_store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <x-input-label for="name" :value="__('Tên sản phẩm')" />
                            <x-text-input id="name" name="name" class="block mt-1 w-full required-field"
                                type="text" required placeholder="Nhập tên sản phẩm" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="mb-3">
                            <x-input-label for="quantity" :value="__('Số lượng sản phẩm')" />
                            <x-text-input id="quantity" name="quantity" class="block mt-1 w-full required-field"
                                type="number" inputmode="numberic" min="0" max="10000000" required
                                placeholder="Nhập số lượng sản phẩm" />
                            <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                        </div>
                        <div class="mb-3">
                            <x-input-label for="price" :value="__('Giá sản phẩm')" />
                            <x-text-input id="price" name="price" class="block mt-1 w-full required-field"
                                type="number" inputmode="numberic" min="0" max="10000000" required
                                placeholder="Nhập giá sản phẩm" />
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>
                        <div class="mb-3">
                            <x-input-label for="category_id" :value="__('Danh mục sản phẩm')" />
                            <x-selector-input id="category_id" name="category_id"
                                class="block mt-1 w-full required-field" :options="$categoryOptions->toArray()" />
                            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                        </div>
                        <div class="mb-3">
                            <x-input-label for="description" :value="__('Mô tả sản phẩm')" />
                            <x-textarea-input id="description" name="description" class="block mt-1 w-full"
                                type="text" rows="8" placeholder="Nhập mô tả" />
                        </div>
                        <div class="mb-3">
                            <x-input-label for="status" :value="__('Tình trạng')" />
                            <x-selector-input id="status" name="status" class="block mt-1 w-full required-field"
                                :disabled="false" :options="['0' => 'Chưa bán', '1' => 'Bán ngay', '2' => 'Chưa công bố']" :selected="1" />
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>
                        <div class="mb-3">
                            <x-input-label for="image" :value="__('Hình ảnh sản phẩm')" />
                            <input type="file" name='image' id="image" class="form-control required-field"
                                accept=".jpeg, .jpg, .png, .gif" required>
                            <div id="image-error" class="text-danger"></div>
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>
                        <x-primary-button class="save-btn">Lưu</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @section('page-script')
        @vite(['resources/assets/js/product-manage.js'])
    @endsection
</x-admin-layout>
