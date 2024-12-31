<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionTransaction;
use Illuminate\Http\Request;

class SubscriptionTransactionController extends Controller
{
    public function index()
    {
        $transactions = SubscriptionTransaction::with(['user', 'subscriptionPlan'])
            ->latest()
            ->paginate(10);

        return view('admin.subscription-transactions.index', compact('transactions'));
    }

    public function updateStatus(Request $request, SubscriptionTransaction $transaction)
    {
        $request->validate([
            'status' => ['required', 'in:pending,success,failed,expired']
        ]);

        $transaction->update([
            'status' => $request->status,
            'paid_at' => $request->status === 'success' ? now() : null
        ]);

        // If status is success, update user's premium status
        if ($request->status === 'success') {
            $user = $transaction->user;
            $user->update([
                'is_premium' => true,
                'premium_expires_at' => now()->addDays($transaction->subscriptionPlan->duration_in_days)
            ]);
        }

        return back()->with('success', 'Status transaksi berhasil diperbarui.');
    }
} 