<?php

namespace App\Models;

use App\Models\JobListing;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobApplication extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'job_listing_id',
        'cover_letter',
        'resume_path',
        'status',
        'notes'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'reviewed_at' => 'datetime'
    ];

    /**
     * Status constants
     */
    const STATUS_PENDING = 'pending';
    const STATUS_REVIEWING = 'reviewing';
    const STATUS_ACCEPTED = 'accepted';
    const STATUS_REJECTED = 'rejected';

    /**
     * Get the user that owns the application
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the job listing that owns the application
     */
    public function jobListing(): BelongsTo
    {
        return $this->belongsTo(JobListing::class);
    }

    /**
     * Get the resume URL
     */
    public function getResumeUrlAttribute(): string
    {
        return asset('storage/' . $this->resume_path);
    }

    /**
     * Scope a query to only include pending applications
     */
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    /**
     * Scope a query to only include reviewing applications
     */
    public function scopeReviewing($query)
    {
        return $query->where('status', self::STATUS_REVIEWING);
    }

    /**
     * Scope a query to only include accepted applications
     */
    public function scopeAccepted($query)
    {
        return $query->where('status', self::STATUS_ACCEPTED);
    }

    /**
     * Scope a query to only include rejected applications
     */
    public function scopeRejected($query)
    {
        return $query->where('status', self::STATUS_REJECTED);
    }

    /**
     * Mark application as reviewing
     */
    public function markAsReviewing(): bool
    {
        return $this->update([
            'status' => self::STATUS_REVIEWING,
            'reviewed_at' => now()
        ]);
    }

    /**
     * Accept the application
     */
    public function accept(?string $notes = null): bool
    {
        return $this->update([
            'status' => self::STATUS_ACCEPTED,
            'notes' => $notes,
            'reviewed_at' => now()
        ]);
    }

    /**
     * Reject the application
     */
    public function reject(?string $notes = null): bool
    {
        return $this->update([
            'status' => self::STATUS_REJECTED,
            'notes' => $notes,
            'reviewed_at' => now()
        ]);
    }
} 