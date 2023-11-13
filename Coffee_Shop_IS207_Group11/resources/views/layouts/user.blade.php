@extends('layouts/app')

@section('layoutContent')
    @include('components.header')

    <main class="main-container">
        @yield('content')
    </main>

    @include('components.footer')
@endsection
