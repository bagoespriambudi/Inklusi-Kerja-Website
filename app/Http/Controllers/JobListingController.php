<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobListingRequest;
use App\Http\Requests\UpdateJobListingRequest;
use App\Models\Company;
use App\Models\JobCategory;
use App\Models\JobListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = JobListing::with(['company', 'jobCategory']);

        // Search
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->has('category')) {
            $query->where('job_category_id', $request->category);
        }

        // Filter by company
        if ($request->has('company')) {
            $query->where('company_id', $request->company);
        }

        // Filter by employment type
        if ($request->has('employment_type')) {
            $query->where('employment_type', $request->employment_type);
        }

        // Filter by status
        if ($request->has('is_active')) {
            $query->where('is_active', $request->is_active);
        }

        $jobListings = $query->latest()->paginate(10);
        $categories = JobCategory::all();
        $companies = Company::all();

        return view('job-listings.index', compact('jobListings', 'categories', 'companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = JobCategory::all();
        $companies = Company::all();

        return view('job-listings.create', compact('categories', 'companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobListingRequest $request)
    {
        JobListing::create($request->validated());

        return redirect()
            ->route('job-listings.index')
            ->with('success', 'Lowongan pekerjaan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(JobListing $jobListing)
    {
        $hasApplied = false;

        if (Auth::check() && Auth::user()->isJobSeeker()) {
            $hasApplied = Auth::user()
                ->jobApplications()
                ->where('job_listing_id', $jobListing->id)
                ->exists();
        }

        return view('job-listings.show', [
            'jobListing' => $jobListing,
            'hasApplied' => $hasApplied,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobListing $jobListing)
    {
        $categories = JobCategory::all();
        $companies = Company::all();

        return view('job-listings.edit', [
            'jobListing' => $jobListing,
            'categories' => $categories,
            'companies' => $companies,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobListingRequest $request, JobListing $jobListing)
    {
        $jobListing->update($request->validated());

        return redirect()
            ->route('job-listings.index')
            ->with('success', 'Lowongan pekerjaan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobListing $jobListing)
    {
        $jobListing->delete();

        return redirect()
            ->route('job-listings.index')
            ->with('success', 'Lowongan pekerjaan berhasil dihapus.');
    }
} 