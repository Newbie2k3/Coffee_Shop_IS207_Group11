<x-guest-layout>
    @section('page-script')
        <script src="{{ asset('assets/js/cart.js') }}"></script>
    @endsection

    <h1>Order Result</h1>
    <p id="orderResult">
        @foreach ($inputData as $key => $value)
            {{ $key }}: {{ $value }} <br>
        @endforeach
    </p>
    <p>Order Status: {{ $order->status_id }}</p>
    <p>debug : {{ $debug }}</p>
</x-guest-layout>
