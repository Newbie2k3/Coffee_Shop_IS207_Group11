<x-app-layout>
    @include('layouts.sections.navigation')

    @section('page-style')
        <link href="{{ asset('assets/vendor/datatables/datatables.min.css') }}" rel="stylesheet">
    @endsection
    @section('page-include-script')
        <script src="{{ asset('assets/vendor/datatables/datatables.min.js') }}" defer></script>
    @endsection

    <!-- Page Heading -->
    @if (isset($header))
        <div class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </div>
    @endif

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>

    @vite(['resources/assets/js/admin-manage.js'])
</x-app-layout>
