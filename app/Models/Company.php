<?php

namespace App\Models;

use App\Models\JobListing;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'logo',
        'website',
        'location',
        'industry',
        'email',
        'phone',
        'address',
        'is_verified'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_verified' => 'boolean'
    ];

    /**
     * Get the job listings for the company
     */
    public function jobListings(): HasMany
    {
        return $this->hasMany(JobListing::class);
    }

    /**
     * Get the logo URL
     */
    public function getLogoUrlAttribute(): ?string
    {
        return $this->logo ? asset('storage/' . $this->logo) : null;
    }

    /**
     * Scope a query to only include verified companies
     */
    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    /**
     * Scope a query to only include companies with active job listings
     */
    public function scopeWithActiveJobs($query)
    {
        return $query->whereHas('jobListings', function ($query) {
            $query->active();
        });
    }
} 