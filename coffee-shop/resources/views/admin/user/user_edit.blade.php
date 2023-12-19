<x-admin-layout>
    @section('title', 'User')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('user') }}">{{ __('User') }}</a>/{{ __('Chỉnh sửa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('user_update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <x-input-label for="name" :value="__('Tên User')" />
                            <x-text-input id="name" class="block mt-1 w-full required-field" type="text"
                                name="name" :value="$user->name" required placeholder="Nhập tên sản phẩm" />
                        </div>
                        <div class="mb-3">
                            <x-input-label for="is_admin" :value="__('Vai trò')" />
                            <x-selector-input id="is_admin" name="is_admin" class="block mt-1 w-full" :disabled="false"
                                :options="['0' => 'Guest', '1' => 'Admin']" :selected="$user->is_admin" />
                        </div>
                        <x-primary-button class="save-btn">Lưu</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
