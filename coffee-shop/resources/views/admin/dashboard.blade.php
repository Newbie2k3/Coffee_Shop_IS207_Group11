<x-admin-layout>
    @section('title', 'Dashboard')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container-fluid">
                <div class="row d-flex align-items-stretch">
                    <div class="col-6 col-md-3">
                        <div class="rounded bg-light p-4 h-100">
                            <div class="h6 text-primary">Doanh thu tháng này</div>
                            <div class="fw-bold fs-2">
                                @formatNumber($revenueThisMonth)
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="rounded bg-light p-4 h-100">
                            <div class="h6 text-primary">Đơn hàng tháng này</div>
                            <div class="fw-bold fs-2">
                                {{ $completedOrdersThisMonth }}
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="rounded bg-light p-4 h-100">
                            <div class="h6 text-primary">Sản phẩm bán chạy nhất</div>
                            <div class="fw-bold fs-4">
                                {{ $bestSellingProduct->name }}
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="rounded bg-light p-4 h-100">
                            <div class="h6 text-primary">Khách hàng tốt nhất</div>
                            <div class="fw-bold fs-4">
                                {{ $topContributor->name }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="rounded bg-light p-4">
                            <div class="h6 text-primary">Doanh thu theo sản phẩm</div>
                            <div>
                                <canvas id="revenueChart" style="width: 100%; height: 300px;"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="rounded bg-light p-4">
                            <div class="h6 text-primary">Doanh thu hàng ngày</div>
                            <div>
                                <canvas id="dailyRevenueChart" style="width: 100%; height: 300px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @section('page-script')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="{{ asset('assets/js/dashboard.js') }}" defer></script>
    @endsection
</x-admin-layout>
