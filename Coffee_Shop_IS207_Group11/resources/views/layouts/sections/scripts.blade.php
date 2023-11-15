<!-- Libs cdn -->
<script src="{{ asset('assets/vendor/libs/bootstrap/bootstrap.js') }}"></script>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
    AOS.init();
</script>

<!-- Page Scripts -->
@yield('page-script')
