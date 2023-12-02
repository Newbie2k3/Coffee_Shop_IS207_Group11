<x-app-layout>
    @include('layouts.sections.header')

    {{ $slot }}

    @include('layouts.sections.footer')

    @section('page-script')
        @auth
            <script src="{{ asset('assets/js/cart.js') }}"></script>
        @endauth
    @endsection
</x-app-layout>
