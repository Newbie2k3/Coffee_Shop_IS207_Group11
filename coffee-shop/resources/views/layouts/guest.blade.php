<x-app-layout>
    @include('layouts.sections.header')

    {{ $slot }}

    @include('layouts.sections.footer')
</x-app-layout>
