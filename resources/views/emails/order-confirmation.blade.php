<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
</head>
<body>
    <h1>Order Confirmation - Order #{{ $order->id }}</h1>
    <p>Dear {{ $order->user->name }},</p>
    <p>Thank you for your order! Here are the details:</p>
    <ul>
        <li><strong>Order ID:</strong> {{ $order->id }}</li>
        <li><strong>Total:</strong> ${{ number_format($order->total, 2) }}</li>
        <li><strong>Status:</strong> {{ $order->status }}</li>
        <li><strong>Address:</strong> {{ $order->address }}, {{ $order->city }}, {{ $order->state }} {{ $order->zip }}, {{ $order->country }}</li>
    </ul>
    <p>We will process your order shortly.</p>
    <br>
    <p>Best regards,<br>The Team</p>
</body>
</html>