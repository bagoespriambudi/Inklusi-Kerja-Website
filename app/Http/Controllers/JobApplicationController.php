<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\JobListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JobApplicationController extends Controller
{
    /**
     * Check if user can apply based on their subscription plan
     */
    private function canUserApply(Request $request)
    {
        $user = $request->user();
        
        // Get today's application count
        $todayApplicationCount = JobApplication::where('user_id', $user->id)
            ->whereDate('created_at', today())
            ->count();

        // If user is not premium or premium has expired, limit to 5 applications per day
        if (!$user->is_premium || $user->premium_expires_at < now()) {
            return [
                'can_apply' => $todayApplicationCount < 5,
                'message' => 'Anda telah mencapai batas 5 lamaran per hari. Upgrade ke premium untuk mengirim lebih banyak lamaran.',
                'remaining' => 5 - $todayApplicationCount
            ];
        }

        // Get user's active subscription plan name, default to 'Free' if no active subscription
        $userPlan = $user->activeSubscription?->subscriptionPlan->name ?? 'Free';

        // Check limits based on subscription plan
        $limits = [
            'Free' => 5,
            'Paket Basic' => 15, 
            'Paket Professional' => 30,
            'Paket Ultimate' => PHP_INT_MAX // unlimited
        ];

        $dailyLimit = $limits[$userPlan] ?? 5;

        return [
            'can_apply' => $todayApplicationCount < $dailyLimit,
            'message' => $todayApplicationCount >= $dailyLimit ? 
                "Anda telah mencapai batas {$dailyLimit} lamaran per hari untuk {$userPlan}." : 
                "Anda masih memiliki " . ($dailyLimit - $todayApplicationCount) . " kesempatan melamar hari ini.",
            'remaining' => $dailyLimit - $todayApplicationCount
        ];
    }

    /**
     * Display a listing of the user's job applications.
     */
    public function index()
    {
        $applications = JobApplication::with(['jobListing.company'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('job-applications.index', compact('applications'));
    }

    /**
     * Store a newly created job application.
     */
    public function store(Request $request)
    {
        $request->validate([
            'job_listing_id' => 'required|exists:job_listings,id',
            'cover_letter' => 'required|string|min:100',
            'resume' => 'required|file|mimes:pdf|max:2048',
            'expected_salary' => 'required|numeric|min:0'
        ]);

        // Check if user can apply
        $applicationCheck = $this->canUserApply($request);
        if (!$applicationCheck['can_apply']) {
            return back()->with('error', $applicationCheck['message']);
        }

        // Check if user has already applied
        $existingApplication = JobApplication::where('user_id', $request->user()->id)
            ->where('job_listing_id', $request->job_listing_id)
            ->exists();

        if ($existingApplication) {
            return back()->with('error', 'Anda sudah pernah melamar untuk lowongan ini.');
        }

        // Store resume file
        $resumePath = $request->file('resume')->store('resumes', 'public');

        // Create job application
        $application = JobApplication::create([
            'user_id' => $request->user()->id,
            'job_listing_id' => $request->job_listing_id,
            'cover_letter' => $request->cover_letter,
            'resume_path' => $resumePath,
            'expected_salary' => $request->expected_salary,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Lamaran berhasil dikirim.');
    }
} 