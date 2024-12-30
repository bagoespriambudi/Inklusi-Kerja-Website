<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionPlan;
use App\Models\SubscriptionTransaction;
use App\Services\MidtransService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SubscriptionCheckoutController extends Controller
{
    protected $midtransService;

    public function __construct(MidtransService $midtransService)
    {
        $this->midtransService = $midtransService;
    }

    public function checkout(SubscriptionPlan $plan)
    {
        $order = [
            'plan_id' => $plan->id,
            'plan_name' => $plan->name,
            'gross_amount' => $plan->price,
            'customer_name' => Auth::user()->name,
            'customer_email' => Auth::user()->email,
        ];

        $result = $this->midtransService->createTransaction($order);

        if (!$result['success']) {
            return redirect()->back()->with('error', 'Gagal membuat transaksi: ' . $result['message']);
        }

        // Create subscription transaction record
        $transaction = SubscriptionTransaction::create([
            'user_id' => Auth::id(),
            'subscription_plan_id' => $plan->id,
            'midtrans_transaction_id' => $result['order_id'],
            'amount' => $plan->price,
            'status' => 'pending',
            'expired_at' => now()->addDays($plan->duration_in_days),
            'payment_details' => json_encode([
                'snap_token' => $result['snap_token'],
                'order_id' => $result['order_id']
            ])
        ]);

        return view('subscription.checkout', [
            'plan' => $plan,
            'snapToken' => $result['snap_token']
        ]);
    }

    public function callback(Request $request)
    {
        // Log raw notification for debugging
        Log::info('Raw Midtrans Notification', $request->all());

        $orderId = $request->order_id;
        $statusCode = $request->status_code;
        $grossAmount = $request->gross_amount;
        $serverKey = config('midtrans.server_key');

        // Generate signature
        $signature = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);

        // Log calculated values for debugging
        Log::info('Midtrans Notification Details', [
            'order_id' => $orderId,
            'transaction_status' => $request->transaction_status,
            'payment_type' => $request->payment_type,
            'received_signature' => $request->signature_key,
            'calculated_signature' => $signature
        ]);

        if ($signature === $request->signature_key) {
            $transaction = SubscriptionTransaction::where('midtrans_transaction_id', $orderId)->first();

            if (!$transaction) {
                Log::error('Transaction not found', ['order_id' => $orderId]);
                return response()->json(['status' => 'error', 'message' => 'Transaction not found'], 404);
            }

            // Update payment details
            $paymentDetails = json_decode($transaction->payment_details, true) ?? [];
            $paymentDetails = array_merge($paymentDetails, [
                'payment_type' => $request->payment_type,
                'transaction_status' => $request->transaction_status,
                'transaction_time' => $request->transaction_time,
                'fraud_status' => $request->fraud_status ?? null,
                'bank' => $request->bank ?? null,
                'va_number' => $request->va_number ?? null,
                'payment_code' => $request->payment_code ?? null,
                'bill_key' => $request->bill_key ?? null,
                'biller_code' => $request->biller_code ?? null,
                'status_code' => $statusCode,
                'signature_key' => $request->signature_key
            ]);

            // Map Midtrans status to our status
            $status = match ($request->transaction_status) {
                'capture' => 'success', // credit card
                'settlement' => 'success', // non credit card
                'pending' => 'pending',
                'deny' => 'failed',
                'cancel' => 'failed',
                'expire' => 'failed',
                'failure' => 'failed',
                'refund' => 'refunded',
                'partial_refund' => 'refunded',
                default => 'pending'
            };

            // Update transaction
            $transaction->update([
                'status' => $status,
                'paid_at' => in_array($request->transaction_status, ['capture', 'settlement']) ? now() : null,
                'payment_details' => json_encode($paymentDetails)
            ]);

            Log::info('Transaction updated', [
                'transaction_id' => $transaction->id,
                'old_status' => $transaction->getOriginal('status'),
                'new_status' => $status
            ]);

            // If payment is successful, update user's subscription
            if (in_array($request->transaction_status, ['capture', 'settlement'])) {
                $user = $transaction->user;
                $plan = $transaction->subscriptionPlan;

                $user->update([
                    'is_premium' => true,
                    'premium_expires_at' => now()->addDays($plan->duration_in_days),
                ]);

                Log::info('User subscription updated', [
                    'user_id' => $user->id,
                    'plan_id' => $plan->id,
                    'expires_at' => now()->addDays($plan->duration_in_days)
                ]);
            }

            return response()->json(['status' => 'success']);
        }

        Log::warning('Invalid signature', [
            'order_id' => $orderId,
            'status_code' => $statusCode,
            'gross_amount' => $grossAmount,
            'received_signature' => $request->signature_key,
            'calculated_signature' => $signature
        ]);

        return response()->json(['status' => 'error', 'message' => 'Invalid signature'], 400);
    }
} 