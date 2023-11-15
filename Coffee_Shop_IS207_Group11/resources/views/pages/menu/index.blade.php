@extends('layouts.user')

@section('title', $title)

@section('page-style')
    <!-- Menu -->
    <link rel="stylesheet" href="{{ asset('assets/css/pages/menu.css') }}">
@endsection

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

    <x-foot-banner/>
@endsection
