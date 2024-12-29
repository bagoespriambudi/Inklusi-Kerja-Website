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
        'title',
        'description',
        'company_id',
        'employment_type',
        'salary_min',
        'salary_max',
        'experience_level',
        'requirements',
        'responsibilities',
        'category_id',
        'deadline',
        'is_active'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'salary_min' => 'decimal:2',
        'salary_max' => 'decimal:2',
        'deadline' => 'date',
        'is_active' => 'boolean'
    ];

    /**
     * Get the category that owns the job listing
     */
    public function category(): BelongsTo
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

    /**
     * Get the formatted salary range
     */
    public function getSalaryRangeAttribute(): string
    {
        if (!$this->salary_min && !$this->salary_max) {
            return 'Negotiable';
        }

        if (!$this->salary_max) {
            return 'From Rp ' . number_format($this->salary_min, 0, ',', '.');
        }

        if (!$this->salary_min) {
            return 'Up to Rp ' . number_format($this->salary_max, 0, ',', '.');
        }

        return 'Rp ' . number_format($this->salary_min, 0, ',', '.') . ' - Rp ' . number_format($this->salary_max, 0, ',', '.');
    }
} 