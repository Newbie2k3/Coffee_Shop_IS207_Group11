<x-admin-layout>
    @section('title', 'Payment Histories')

    <x-slot name="header">
        <div class="position-relative">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Payment Histories') }}
            </h2>

            <a href="{{ route('payment.export') }}"
                class="btn btn-primary position-absolute translate-middle top-3 end-0">Xuất hóa đơn</a>
        </div>
    </x-slot>

    <div class="container-fluid px-5 py-4">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <table id="myTable" class="display" style="width:100%;">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Người Thanh Toán</th>
                            <th>Mã Hóa Đơn</th>
                            <th id="price-column">Giá</th>
                            <th>Số Lượng Sản Phẩm</th>
                            <th>Thời gian</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoices as $index => $invoice)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $invoice->user->name ?? "Đã xóa" }}</td>
                                <td>{{ $invoice->id }}</td>
                                <td>@formatNumber($invoice->amount)</td>
                                <td>{{ $invoice->payment_details->sum('quantity') }}</td>
                                <td>{{ $invoice->created_at }}</td>
                                <td>
                                    <x-danger-button type="button" class="detail-btn"
                                        data-details="{{ $invoice->payment_details }}">
                                        Chi tiết
                                    </x-danger-button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @section('page-script')
        @vite(['resources/assets/js/payment-manage.js'])
    @endsection
</x-admin-layout>
