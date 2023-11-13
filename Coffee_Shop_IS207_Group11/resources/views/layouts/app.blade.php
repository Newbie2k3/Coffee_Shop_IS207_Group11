<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Shop</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>

<body>
    @include('components.header')

    <main class="main-container">
        @yield('content')
        <button class="btn btn-success">Easy Bootstrap</button>
    </main>

    @include('components.footer')

    <!-- Scripts -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
</body>

</html>
