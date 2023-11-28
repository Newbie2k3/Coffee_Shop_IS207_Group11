<x-app-layout>
    <div class="min-h-screen bg-gray-100">
        @include('layouts.sections.navigation')

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
    </div>
</x-app-layout>
