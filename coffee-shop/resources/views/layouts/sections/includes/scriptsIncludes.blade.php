<!-- CDN Scripts -->

<!-- My Scripts -->
@vite(['resources/css/app.css', 'resources/js/app.js'])

<script>
    function replaceImage(img) {
        const replacementSrc = "{{ asset('assets/img/loading.gif') }}";
        img.src = replacementSrc;
    }
</script>

<!-- Page Scripts -->
@yield('page-script')