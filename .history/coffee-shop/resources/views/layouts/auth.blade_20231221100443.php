<x-app-layout>
    
        <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 bg-img max-w-screen sm:justify-center sm:pt-0 ">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 text-gray-500 fill-current" />
                </a>
            </div>

            <div class="w-full px-6 py-4 mt-6 overflow-hidden bg-white shadow-md hightlight sm:max-w-md sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    
</x-app-layout>
