<x-admin-layout>
    @section('title', 'Category')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('category') }}">{{ __('Category') }}</a>/{{ __('Chỉnh sửa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('category_update', $category->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <x-input-label for="name" :value="__('Tên danh mục')" />
                            <x-text-input value="{{ $category->name }}" id="name" name="name"
                                class="block mt-1 w-full required-field" type="text" required
                                placeholder="Nhập tên danh mục" />
                        </div>
                        <div class="mb-3">
                            <x-input-label for="description" :value="__('Mô tả danh mục')" />
                            <x-textarea-input id="description" name="description" class="block mt-1 w-full"
                                type="text" rows="8"
                                placeholder="Nhập mô tả">{{ $category->description }}</x-textarea-input>
                        </div>
                        <x-primary-button class="save-btn">Lưu</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
