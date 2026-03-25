@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-12 px-4">
    <h2 class="text-2xl font-bold mb-2">Order Payment #{{ $order->id }}</h2>
    <p class="text-gray-600 mb-4">Complete payment securely with Razorpay.</p>

    <div class="mb-6 rounded-lg border border-gray-200 bg-gray-50 p-4">
        <p class="text-sm font-semibold text-gray-800 mb-1">Selected Payment Method</p>
        <p class="text-sm text-gray-600">Razorpay - UPI / Card / Netbanking / Wallet</p>
        <p class="text-sm text-gray-700 mt-2">Amount: <span class="font-semibold">INR {{ number_format($order->total, 2) }}</span></p>
    </div>

    <button id="rzp-button" class="px-6 py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
        Pay Now with Razorpay
    </button>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
document.getElementById('rzp-button').onclick = function(e){
    e.preventDefault();
    
    fetch("{{ route('payment.pay', $order->id) }}", {
        method: 'POST',
        credentials: 'same-origin',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: JSON.stringify({}),
    })
    .then(async res => {
        const text = await res.text();
        try { return JSON.parse(text); } catch (e) { throw new Error(text); }
    })
    .then(data => {
        if (!data.success) {
            alert("Error: " + data.message);
            return;
        }

        var options = {
            "key": data.key,
            "amount": data.amount,
            "currency": data.currency,
            "name": "prem Store",
            "description": "Order #{{ $order->id }}",
            "order_id": data.razorpay_order_id,
            "handler": function (response){
                // Verify payment on backend
                fetch("{{ route('payment.verify') }}", {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        razorpay_payment_id: response.razorpay_payment_id,
                        razorpay_order_id: response.razorpay_order_id,
                        razorpay_signature: response.razorpay_signature
                    })
                })
                .then(res => res.json())
                .then(verifyData => {
                    if (verifyData.success) {
                        alert("Payment successful!");
                        window.location.href = "{{ route('orders.history') }}";
                    } else {
                        alert("Payment verification failed: " + verifyData.message);
                    }
                });
            },
            "prefill": {
                "name": "{{ auth()->user()->name }}",
                "email": "{{ auth()->user()->email }}"
            },
            "theme": {
                "color": "#6366F1"
            }
        };
        var rzp1 = new Razorpay(options);
        rzp1.open();
    })
    .catch(error => {
        console.error('Error:', error);
        alert("Something went wrong. Please check your console.");
    });
}
</script>
@endsection