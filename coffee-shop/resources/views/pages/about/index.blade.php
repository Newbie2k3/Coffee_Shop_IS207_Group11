<x-guest-layout>
    @section('title', $title)
    @section('page-style')
        <!-- Menu -->
        <link rel="stylesheet" href="{{ asset('assets/css/pages/phucdeptrai_about.css') }}">
    @endsection

    <x-big-banner :imgUrl="'assets/img/backgrounds/home-bg.jpg'">
        <h1>About Us</h1>
    </x-big-banner>

    @include('pages.about.phucdeptrai')
</x-guest-layout>