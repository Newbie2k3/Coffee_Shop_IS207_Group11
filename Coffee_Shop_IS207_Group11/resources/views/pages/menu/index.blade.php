@extends('layouts.user')

@section('title', $title)

@section('page-style')
    <!-- Menu -->
    <link rel="stylesheet" href="{{ asset('assets/css/pages/menu.css') }}">
@endsection

<?php
$menu = [
    'starter' => [
        [
            'title' => 'Cornish - Mackerel',
            'imgUrl' => 'assets/img/product/dish-1.jpg',
            'price' => '20.00',
            'description' => 'A small river named Duden flows by their place and supplies',
        ],
        [
            'title' => 'Roasted Steak',
            'imgUrl' => 'assets/img/product/dish-2.jpg',
            'price' => '29.00',
            'description' => 'A small river named Duden flows by their place and supplies',
        ],
        [
            'title' => 'Seasonal Soup',
            'imgUrl' => 'assets/img/product/dish-3.jpg',
            'price' => '20.00',
            'description' => 'A small river named Duden flows by their place and supplies',
        ],
        [
            'title' => 'Chicken Curry',
            'imgUrl' => 'assets/img/product/dish-4.jpg',
            'price' => '20.00',
            'description' => 'A small river named Duden flows by their place and supplies',
        ],
    ],
    'main_dish' => [
        [
            'title' => 'Sea Trout',
            'imgUrl' => 'assets/img/product/dish-5.jpg',
            'price' => '49.91',
            'description' => 'A small river named Duden flows by their place and supplies',
        ],
        [
            'title' => 'Roasted Beef',
            'imgUrl' => 'assets/img/product/dish-6.jpg',
            'price' => '20.00',
            'description' => 'A small river named Duden flows by their place and supplies',
        ],
        [
            'title' => 'Butter Fried Chicken',
            'imgUrl' => 'assets/img/product/dish-7.jpg',
            'price' => '20.00',
            'description' => 'A small river named Duden flows by their place and supplies',
        ],
        [
            'title' => 'Chiken Filet',
            'imgUrl' => 'assets/img/product/dish-8.jpg',
            'price' => '20.00',
            'description' => 'A small river named Duden flows by their place and supplies',
        ],
    ],
    'desserts' => [
        [
            'title' => 'Cornish - Mackerel',
            'imgUrl' => 'assets/img/product/dessert-1.jpg',
            'price' => '20.00',
            'description' => 'A small river named Duden flows by their place and supplies',
        ],
        [
            'title' => 'Roasted Steak',
            'imgUrl' => 'assets/img/product/dessert-2.jpg',
            'price' => '29.00',
            'description' => 'A small river named Duden flows by their place and supplies',
        ],
        [
            'title' => 'Seasonal Soup',
            'imgUrl' => 'assets/img/product/dessert-3.jpg',
            'price' => '20.00',
            'description' => 'A small river named Duden flows by their place and supplies',
        ],
        [
            'title' => 'Chicken Curry',
            'imgUrl' => 'assets/img/product/dessert-4.jpg',
            'price' => '20.00',
            'description' => 'A small river named Duden flows by their place and supplies',
        ],
    ],
    'drinks' => [
        [
            'title' => 'Sea Trout',
            'imgUrl' => 'assets/img/product/drink-5.jpg',
            'price' => '49.91',
            'description' => 'A small river named Duden flows by their place and supplies',
        ],
        [
            'title' => 'Roasted Beef',
            'imgUrl' => 'assets/img/product/drink-6.jpg',
            'price' => '20.00',
            'description' => 'A small river named Duden flows by their place and supplies',
        ],
        [
            'title' => 'Butter Fried Chicken',
            'imgUrl' => 'assets/img/product/drink-7.jpg',
            'price' => '20.00',
            'description' => 'A small river named Duden flows by their place and supplies',
        ],
        [
            'title' => 'Chiken Filet',
            'imgUrl' => 'assets/img/product/drink-8.jpg',
            'price' => '20.00',
            'description' => 'A small river named Duden flows by their place and supplies',
        ],
    ],
];

?>

@section('content')
    <x-head-banner :imgUrl="'assets/img/backgrounds/menu-bg.jpg'">
        <div class="col-md-7 col-sm-12 text-center">
            <h1 class="mb-3 mt-5 bread">Our Menu</h1>
            <p class="breadcrumbs">
                <span class="mr-2"><a href="{{ route('home') }}">Home</a></span>
                <span>Menu</span>
            </p>
        </div>
    </x-head-banner>

    <x-foot-banner />
    <section class="ftco-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-5 pb-3">
                    <h3 class="mb-5 heading-pricing">Starter</h3>
                    @foreach ($menu['starter'] as $item)
                        <x-menu-item 
                            :imgUrl="$item['imgUrl']" 
                            :title="$item['title']" 
                            :price="$item['price']" 
                            :description="$item['description']" />
                    @endforeach
                </div>

                <div class="col-md-6 mb-5 pb-3">
                    <h3 class="mb-5 heading-pricing">Main Dish</h3>
                    @foreach ($menu['main_dish'] as $item)
                        <x-menu-item 
                            :imgUrl="$item['imgUrl']" 
                            :title="$item['title']" 
                            :price="$item['price']" 
                            :description="$item['description']" />
                    @endforeach
                </div>

                <div class="col-md-6">
                    <h3 class="mb-5 heading-pricing">Desserts</h3>
                    @foreach ($menu['desserts'] as $item)
                        <x-menu-item 
                            :imgUrl="$item['imgUrl']" 
                            :title="$item['title']" 
                            :price="$item['price']" 
                            :description="$item['description']" />
                    @endforeach
                </div>

                <div class="col-md-6">
                    <h3 class="mb-5 heading-pricing">Drinks</h3>
                    @foreach ($menu['drinks'] as $item)
                        <x-menu-item 
                            :imgUrl="$item['imgUrl']" 
                            :title="$item['title']" 
                            :price="$item['price']" 
                            :description="$item['description']" />
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
