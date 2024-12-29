<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'content',
        'rating',
        'is_visible'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'rating' => 'integer',
        'is_visible' => 'boolean'
    ];

    /**
     * Get the user that owns the review
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to only include visible reviews
     */
    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }

    /**
     * Scope a query to only include reviews with rating
     */
    public function scopeWithRating($query)
    {
        return $query->whereNotNull('rating');
    }

    /**
     * Get the formatted rating (stars)
     */
    public function getRatingStarsAttribute(): string
    {
        if (!$this->rating) {
            return 'No Rating';
        }

        return str_repeat('★', $this->rating) . str_repeat('☆', 5 - $this->rating);
    }

    /**
     * Hide the review
     */
    public function hide(): bool
    {
        return $this->update(['is_visible' => false]);
    }

    /**
     * Show the review
     */
    public function show(): bool
    {
        return $this->update(['is_visible' => true]);
    }

    /**
     * Toggle review visibility
     */
    public function toggleVisibility(): bool
    {
        return $this->update(['is_visible' => !$this->is_visible]);
    }
} 