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
                    {{ __("Chỉnh sửa User") }}
                    <form action="{{ route('user_update',$user->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên User</label>
                            <input type="text" name='name' value="{{ $user->name }}" class="form-control" placeholder="Nhập tên sản phẩm" >
                          </div>
                          <div class="mb-3">
                              <label for="is_admin" class="form-label">Vai trò</label>
                              <select name="is_admin">
                                  <option value="0" {{ $user->is_admin == 0 ? 'selected' : '' }}>Guest</option>
                                  <option value="1" {{ $user->is_admin == 1 ? 'selected' : '' }}>Admin</option>
                              </select>
                          </div>
                          <x-primary-button>Lưu</x-primary-button>
                      </form>                
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>