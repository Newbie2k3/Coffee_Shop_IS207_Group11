<x-admin-layout>
    @section('title', 'User')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("User Management") }}
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Tên khách hàng</th>
                            <th scope="col">Email</th>
                            <th scope="col">Quyền</th>
                            <th scope="col" colspan="2">
                                Thao tác
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($user as $item)
                          <tr>
                            <th scope="row">{{ $item->name }}</th>
                            <td>{{ $item->email }}</td>
                            <td>
                                <?php
                                    if($item->is_admin== '0'){
                                        echo "Guest";
                                    }else{
                                        echo "Admin";
                                    }
                                ?>
                            </td>
                            <td>
                                <form action="{{ URL::to('user_destroy',$item->id) }}" method="POST">
                                    <a href="{{ URL::to('user_edit',$item->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Sửa</a>
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button >Xóa</x-danger-button>
                                </form>
                            </td>
                          </tr>
                        @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>