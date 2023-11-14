@extends('layouts.user')

@section('title', 'Home')

@section('content')
    <section class="home-slider owl-carousel">
        <div class="slider-item" style="background-image: url(assets/img/slider/bg-1.jpg);">
            <div class="container">
                <div class="overlay"></div>
                <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

                    <div class="col-md-8 col-sm-12 text-center">
                        <span class="subheading">Welcome</span>
                        <h1 class="mb-4">The Best Coffee Testing Experience</h1>
                        <p class="mb-4 mb-md-5">A small river named Duden flows by their place and supplies it with the
                            necessary regelialia.</p>
                        <p><a href="#" class="btn btn-primary p-3 px-xl-4 py-xl-3">Mua ngay</a> <a href="#"
                                class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">Xem sản phẩm</a></p>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
