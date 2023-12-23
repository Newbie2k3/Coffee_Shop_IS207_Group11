<x-guest-layout>
    @section('title', $title)
    @section('page-style')
        <!-- Menu -->
        {{-- <link rel="stylesheet" href="{{ asset('assets/css/pages/phucdeptrai_about.css') }}"> --}}
        @vite(['resources/assets/css/pages/about.css'])
    @endsection

    <x-big-banner :imgUrl="'assets/img/backgrounds/home-bg.jpg'">
        <div class="col-md-8 col-sm-12 text-center">
            <span class="subheading">About us</span>
            <h1 class="mb-4">The Best Coffee Testing Experience</h1>
            <p class="mb-4 mb-md-5">
                A small river named Duden flows by
                their place and supplies it with the
                necessary regelialia.
            </p>
            
        </div>
    </x-big-banner>
    @include('pages.about.phucdeptrai')
</x-guest-layout>