<x-app-layout>
    @include('layouts.sections.header')

    {{ $slot }}

    @include('layouts.sections.footer')

    @vite(['resources/assets/js/cart.js'])
</x-app-layout>
