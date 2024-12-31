<?php

namespace App\Models;

use App\Models\Company;
use App\Models\JobApplication;
use App\Models\JobCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JobListing extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company_id',
        'job_category_id',
        'title',
        'description',
        'requirements',
        'benefits',
        'employment_type',
        'experience_level',
        'location',
        'salary_range',
        'deadline',
        'is_active'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'deadline' => 'date',
        'is_active' => 'boolean'
    ];

    /**
     * Get the category that owns the job listing
     */
    public function jobCategory(): BelongsTo
    {
        return $this->belongsTo(JobCategory::class);
    }

    /**
     * Get the company that owns the job listing
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the applications for the job listing
     */
    public function applications(): HasMany
    {
        return $this->hasMany(JobApplication::class);
    }

    /**
     * Scope a query to only include active job listings
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include jobs that haven't passed their deadline
     */
    public function scopeAvailable($query)
    {
        return $query->where(function($q) {
            $q->whereNull('deadline')
              ->orWhere('deadline', '>=', now());
        })->active();
    }
} 