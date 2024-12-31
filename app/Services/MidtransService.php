<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;

class MidtransService
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$clientKey = config('midtrans.client_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function createTransaction($order)
    {
        $transaction_details = [
            'order_id' => 'SUBS-' . time(),
            'gross_amount' => $order['gross_amount'],
        ];

        $customer_details = [
            'first_name' => $order['customer_name'],
            'email' => $order['customer_email'],
        ];

        $item_details = [
            [
                'id' => $order['plan_id'],
                'price' => $order['gross_amount'],
                'quantity' => 1,
                'name' => $order['plan_name'],
            ]
        ];

        $payload = [
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'item_details' => $item_details,
        ];

        try {
            $snapToken = Snap::getSnapToken($payload);
            return [
                'success' => true,
                'snap_token' => $snapToken,
                'order_id' => $transaction_details['order_id']
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }
} 