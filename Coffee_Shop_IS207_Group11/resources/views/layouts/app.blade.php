<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Shop</title>
</head>
<body>
    @include('components.header')

    <main class="main-container">
        @yield('content')
    </main>

    @include('components.footer')
</body>
</html>