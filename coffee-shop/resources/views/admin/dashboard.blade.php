<x-admin-layout>
    @section('title', 'Dashboard')
    @section('page-script')
        <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    @endsection
    @section('page-style')
        <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="d-flex align-content-center justify-content-between pt-3 pb-3">
            <h4 class="mb-0 fs-20px">Bảng điều khiển</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/Manager/Dashboard" class="text-decoration-none text-primary">Tổng
                            quan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Bảng điều khiển</li>
                </ol>
            </nav>
        </div>

        <div class="row mt-2">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Doanh thu trong ngày
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $doanh_thu_trong_ngay }} VND
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Số lượng danh mục
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $so_luong_danh_muc }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Số lượng sản phẩm
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $so_luong_san_pham }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Đơn hàng trong ngày
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $don_hang_trong_ngay }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <p class="mt-2 fs-18px text-success">Biểu đồ thống kê dự án đang thực hiện</p>
        </div>
        <div class="row mt-2 mb-3">
            <div class="col-lg-8">
            </div>
            <div class="col-lg-4">
                <div class="p-2 shadow border rounded">
                    <canvas id="pieChart"></canvas>
                    <p class="fs-18px mt-2 mb-2 text-center">Biểu đồ phân bố nguồn lực</p>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
