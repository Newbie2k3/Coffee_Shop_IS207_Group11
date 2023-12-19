<x-admin-layout>
    @section('page-script')
        <script src="{{ asset('assets/js/order.js') }}"></script>
    @endsection
    <table id="myOrderTable">
        <thead>
            <tr>
                <th>Mã order</th>
                <th>Tên người dùng</th>
                <th>Phương thức thanh toán</th>
                <th>Trạng thái</th>
                <th>Tổng tiền</th>
            </tr>
        </thead>
    </table>
</x-admin-layout>
