<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
</head>
<body>
    <h1>Invoice for Order #{{ $order->id }}</h1>
    <p>Dear {{ $order->user->name }},</p>
    <p>Your payment has been successfully processed. Here is your invoice:</p>
    <h2>Order Details</h2>
    <ul>
        <li><strong>Order ID:</strong> {{ $order->id }}</li>
        <li><strong>Total:</strong> ${{ number_format($order->total, 2) }}</li>
        <li><strong>Status:</strong> {{ $order->status }}</li>
    </ul>
    <h2>Payment Details</h2>
    <ul>
        <li><strong>Amount:</strong> ${{ number_format($payment->amount, 2) }}</li>
        <li><strong>Payment Method:</strong> {{ $payment->payment_method }}</li>
        <li><strong>Transaction ID:</strong> {{ $payment->transaction_id }}</li>
        <li><strong>Status:</strong> {{ $payment->status }}</li>
    </ul>
    <p>Thank you for your business!</p>
    <br>
    <p>Best regards,<br>The Team</p>
</body>
</html>