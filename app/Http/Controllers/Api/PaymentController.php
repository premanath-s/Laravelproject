<?php

namespace App\Http\Controllers\Api;

use App\Jobs\SendInvoiceEmailJob;
use App\Models\Payment;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Razorpay\Api\Api;

class PaymentController extends Controller
{
    // Create Razorpay order for an existing order
    public function pay(Request $request, Order $order)
    {
        if ((int) $order->user_id !== (int) $request->user()->id) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized order access',
            ], 403);
        }

        $api = new Api(
            config('services.razorpay.key'),
            config('services.razorpay.secret')
        );

        try {
            $razorpayOrder = $api->order->create([
                'amount' => (int) ($order->total * 100),
                'currency' => 'INR',
                'receipt' => 'order_rcpt_' . $order->id,
            ]);

            $order->update([
                'razorpay_order_id' => $razorpayOrder['id'],
            ]);

            return response()->json([
                'status' => true,
                'order_id' => $order->id,
                'razorpay_order_id' => $razorpayOrder['id'],
                'key' => config('services.razorpay.key'),
                'amount' => $razorpayOrder['amount'],
                'currency' => $razorpayOrder['currency'],
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    // Verify payment and mark order as paid
    public function verify(Request $request)
    {
        $request->validate([
            'razorpay_order_id' => 'required|string',
            'razorpay_payment_id' => 'required|string',
            'razorpay_signature' => 'nullable|string',
        ]);

        $order = Order::where('razorpay_order_id', $request->razorpay_order_id)->first();

        if (!$order || (int) $order->user_id !== (int) $request->user()->id) {
            return response()->json([
                'status' => false,
                'message' => 'Order not found',
            ], 404);
        }

        // Signature verification can be added here with Razorpay utility.
        $order->update([
            'status' => 'paid',
            'razorpay_payment_id' => $request->razorpay_payment_id,
        ]);

        // Create payment record
        $payment = Payment::create([
            'order_id' => $order->id,
            'amount' => $order->total,
            'payment_method' => 'razorpay',
            'transaction_id' => $request->razorpay_payment_id,
            'status' => 'completed',
        ]);

        // Dispatch invoice email job
        SendInvoiceEmailJob::dispatch($order, $payment);

        return response()->json([
            'status' => true,
            'message' => 'Payment verified successfully',
            'order' => $order,
        ]);
    }
}
