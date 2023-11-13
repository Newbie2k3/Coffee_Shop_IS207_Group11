<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Title -->
    <title>@yield('title') | Coffee Shop</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    <!-- Include Styles -->
    @include('layouts/sections/styles')

    <!-- Include Scripts -->
    @include('layouts/sections/scriptsIncludes')
</head>

<body>
    <!-- Layout Content -->
    @yield('layoutContent')

    <!-- Include Scripts -->
    @include('layouts/sections/scripts')
</body>

</html>
