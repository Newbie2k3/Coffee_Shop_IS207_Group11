@forelse ($products as $index => $item)
    <tr class="product_{{ $item->id }}">
        <td>{{ $index + 1 }}</td>
        <td>{{ $item->name }}</td>
        <td>{{ $item->description }}</td>
        <td>{{ $item->category->name }}</td>
        <td>
            <?php
            if ($item->status == '0') {
                echo 'Ẩn';
            } else {
                echo 'Hiện';
            }
            ?>
        </td>
        <td>@formatNumber($item->price)</td>
        <td><img src="{{ asset('assets/img/product/' . $item->image) }}" alt="{{ $item->name }}"
                style="width:120px; height:120px; object-fit: cover; vertical-align: middle;">
        </td>
        <td>
            <a href="{{ route('product_edit', $item->id) }}"
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Sửa</a>

            <x-danger-button type="button" class="delete-btn" data-id="{{ $item->id }}">Xóa</x-danger-button>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="8">
            @if (isset($keyword) || $categoryId)
                Không có sản phẩm phù hợp với tìm kiếm của bạn.
            @else
                Không có sản phẩm nào trong kho.
            @endif
        </td>
    </tr>
@endforelse
