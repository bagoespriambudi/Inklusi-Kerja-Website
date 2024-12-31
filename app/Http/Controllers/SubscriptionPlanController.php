<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionPlan;
use App\Http\Requests\StoreSubscriptionPlanRequest;
use App\Http\Requests\UpdateSubscriptionPlanRequest;

class SubscriptionPlanController extends Controller
{
    /**
     * Display a listing of the subscription plans.
     */
    public function index()
    {
        $subscriptionPlans = SubscriptionPlan::latest()->paginate(10);
        return view('subscription-plans.index', compact('subscriptionPlans'));
    }

    /**
     * Show the form for creating a new subscription plan.
     */
    public function create()
    {
        return view('subscription-plans.create');
    }

    /**
     * Store a newly created subscription plan in storage.
     */
    public function store(StoreSubscriptionPlanRequest $request)
    {
        $data = $request->validated();
        
        // Convert features from array to JSON
        if (isset($data['features'])) {
            $data['features'] = json_encode($data['features']);
        }

        SubscriptionPlan::create($data);

        return redirect()
            ->route('subscription-plans.index')
            ->with('success', 'Paket berlangganan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified subscription plan.
     */
    public function edit(SubscriptionPlan $subscriptionPlan)
    {
        return view('subscription-plans.edit', compact('subscriptionPlan'));
    }

    /**
     * Update the specified subscription plan in storage.
     */
    public function update(UpdateSubscriptionPlanRequest $request, SubscriptionPlan $subscriptionPlan)
    {
        $data = $request->validated();
        
        // Convert features from array to JSON
        if (isset($data['features'])) {
            $data['features'] = json_encode($data['features']);
        }

        $subscriptionPlan->update($data);

        return redirect()
            ->route('subscription-plans.index')
            ->with('success', 'Paket berlangganan berhasil diperbarui.');
    }

    /**
     * Remove the specified subscription plan from storage.
     */
    public function destroy(SubscriptionPlan $subscriptionPlan)
    {
        $subscriptionPlan->delete();

        return redirect()
            ->route('subscription-plans.index')
            ->with('success', 'Paket berlangganan berhasil dihapus.');
    }
} 