<x-guest-layout>
    @section('title', $title)

    {{-- @section('page-style')
        <!-- Menu -->
        <link rel="stylesheet" href="{{ asset('assets/css/pages/menu.css') }}">
    @endsection --}}

    <?php
    $menu = [
        'drink' => [],
        'tool' => [],
    ];
                foreach ($product as $key => $drink) {
                    if($drink->category_id == 1){
                        $menu['drink'][] = [
                        'title' => $drink->name,
                        'imgUrl' => 'assets/img/product/' . $drink->image,
                        'price' => $drink->price,
                        'description' => $drink->description,
                        ];
                    }
                }
    
                foreach ($product as $key => $tool) {
                    if($tool->category_id == 2){
                        $menu['tool'][] = [
                        'title' => $tool->name,
                        'imgUrl' => 'assets/img/product/' . $tool->image,
                        'price' => $tool->price,
                        'description' => $tool->description,
                        ];
                    }
                }
    ?>

    <x-big-banner :imgUrl="'assets/img/backgrounds/menu-bg.jpg'">
        <div class="col-md-7 col-sm-12 text-center">
            <h1 class="mb-3 mt-5 bread">Sản phẩm</h1>
            <p class="breadcrumbs">
                <span class="mr-2"><a href="{{ route('home') }}">Home</a></span>
                <span>Menu</span>
            </p>
        </div>
    </x-big-banner>

    <x-intro />

    <section class="ftco-section py-5" style="padding: 72px;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-5 pb-3">
                    <h3 class="mb-5 heading-pricing">Thức uống</h3>
                    @foreach ($menu['drink'] as $item)
                        <a href="{{ route('cart') }}"><x-menu-item imgUrl="{{ $item['imgUrl'] }}" title="{{ $item['title']  }}" price="{{ $item['price'] }}" description="{{ $item['description'] }}" /></a>
                    @endforeach
                </div>

                <div class="col-md-6 mb-5 pb-3">
                    <h3 class="mb-5 heading-pricing">Dụng cụ pha chế</h3>
                    @foreach ($menu['tool'] as $item)
                        <a href="{{ route('cart') }}"><x-menu-item imgUrl="{{ $item['imgUrl'] }}" title="{{ $item['title']  }}" price="{{ $item['price'] }}" description="{{ $item['description'] }}" /></a>
                    @endforeach
                </div>

            </div>
        </div>
    </section>
</x-guest-layout>
