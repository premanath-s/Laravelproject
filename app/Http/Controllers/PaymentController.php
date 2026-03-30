<?php

namespace App\Http\Controllers;

use App\Jobs\SendInvoiceEmailJob;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\Order;
use Razorpay\Api\Api;

class PaymentController extends Controller
{
    // Show payment page (you can keep this, no issue)
    public function show(Order $order)
    {
        return view('checkout.payment', compact('order'));
    }

    // Create Razorpay order
    public function pay(Request $request, Order $order)
    {
        $razorpayKey = config('services.razorpay.key');
        $razorpaySecret = config('services.razorpay.secret');

        if (empty($razorpayKey) || empty($razorpaySecret)) {
            return response()->json([
                'success' => false,
                'message' => 'Razorpay credentials missing. Set `RAZORPAY_KEY` and `RAZORPAY_SECRET` in `.env` and clear config cache.',
            ], 500);
        }

        $api = new Api(
            $razorpayKey,
            $razorpaySecret
        );

        try {
            // Create order in Razorpay
            $razorpayOrder = $api->order->create([
                'amount' => (int)($order->total * 100), // in paise
                'currency' => 'INR',
                'receipt' => 'order_rcpt_' . $order->id,
            ]);

            // Save Razorpay order ID in DB
            $order->update([
                'razorpay_order_id' => $razorpayOrder['id']
            ]);

            return response()->json([
                'success' => true,
                'order_id' => $order->id,
                'razorpay_order_id' => $razorpayOrder['id'],
                'key' => config('services.razorpay.key'),
                'amount' => $razorpayOrder['amount'],
                'currency' => $razorpayOrder['currency']
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // Verify payment and mark as paid
    public function verify(Request $request)
    {
        $order = Order::where('razorpay_order_id', $request->razorpay_order_id)->first();

        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Order not found']);
        }

        // In a real app, you should verify the signature here using Razorpay SDK
        // $attributes = [
        //     'razorpay_order_id' => $request->razorpay_order_id,
        //     'razorpay_payment_id' => $request->razorpay_payment_id,
        //     'razorpay_signature' => $request->razorpay_signature
        // ];
        // $api->utility->verifyPaymentSignature($attributes);

        $order->update([
            'status' => 'paid',
            'razorpay_payment_id' => $request->razorpay_payment_id
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

        return response()->json(['success' => true]);
    }
}