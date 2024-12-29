<?php

namespace App\Models;

use App\Models\SubscriptionTransaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubscriptionPlan extends Model
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
        'price',
        'duration_in_days',
        'features',
        'is_active'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
        'duration_in_days' => 'integer',
        'features' => 'array',
        'is_active' => 'boolean'
    ];

    /**
     * Get the transactions for the subscription plan
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(SubscriptionTransaction::class);
    }

    /**
     * Get formatted price
     */
    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    /**
     * Get formatted duration
     */
    public function getFormattedDurationAttribute(): string
    {
        if ($this->duration_in_days % 30 === 0) {
            $months = $this->duration_in_days / 30;
            return $months . ' ' . str('month')->plural($months);
        }
        
        return $this->duration_in_days . ' ' . str('day')->plural($this->duration_in_days);
    }

    /**
     * Scope a query to only include active plans
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Calculate expiry date from now
     */
    public function calculateExpiryDate(): string
    {
        return now()->addDays($this->duration_in_days)->format('Y-m-d H:i:s');
    }
} 