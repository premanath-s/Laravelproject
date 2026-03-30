<!DOCTYPE html>
<html>
<head>
    <title>Order Shipped</title>
</head>
<body>
    <h1>Your Order Has Been Shipped!</h1>
    <p>Dear {{ $order->user->name }},</p>
    <p>Great news! Your order #{{ $order->id }} has been shipped.</p>
    <p>You can track your order using the tracking information provided in your account.</p>
    <p>Thank you for shopping with us!</p>
    <br>
    <p>Best regards,<br>The Team</p>
</body>
</html>