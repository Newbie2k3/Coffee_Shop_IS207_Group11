<x-admin-layout>
    @section('title', 'Category')

    <x-slot name="header">
        <div class="position-relative">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Category') }}
            </h2>

            <a href="{{ route('category_create') }}"
                class="btn btn-primary position-absolute translate-middle top-3 end-0">Thêm danh mục mới</a>
        </div>
    </x-slot>

    <div class="container-fluid px-5 py-4">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <table id="myTable" class="display" style="width:100%;">
                    <thead>
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Tên danh mục</th>
                            <th scope="col">Mô tả danh mục</th>
                            <th scope="col">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($category as $index => $item)
                            <tr class="rowid_{{ $item->id }}">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->description }}</td>
                                <td>
                                    <a href="{{ route('category_edit', $item->id) }}"
                                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Sửa</a>

                                    <x-danger-button type="button" class="delete-btn"
                                        data-id="{{ $item->id }}">Xóa</x-danger-button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        const csrfToken = "{{ csrf_token() }}";
        const itemDeleteUrl = "{{ route('category_destroy', [':id']) }}";
    </script>
</x-admin-layout>
