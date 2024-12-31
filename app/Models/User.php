<?php

namespace App\Models;

use App\Models\JobApplication;
use App\Models\Review;
use App\Models\SubscriptionTransaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone_number',
        'address',
        'resume_path',
        'avatar',
        'is_premium',
        'premium_expires_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_premium' => 'boolean',
            'premium_expires_at' => 'datetime',
        ];
    }

    /**
     * Check if the user is an admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if the user is a job seeker
     */
    public function isJobSeeker(): bool
    {
        return $this->role === 'jobseeker';
    }

    /**
     * Check if the user has an active premium subscription
     */
    public function hasPremium(): bool
    {
        if (!$this->is_premium) {
            return false;
        }

        return $this->premium_expires_at === null || $this->premium_expires_at->isFuture();
    }

    /**
     * Get all job applications for the user
     */
    public function jobApplications(): HasMany
    {
        return $this->hasMany(JobApplication::class);
    }

    /**
     * Get all reviews by the user
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get all subscription transactions for the user
     */
    public function subscriptionTransactions(): HasMany
    {
        return $this->hasMany(SubscriptionTransaction::class);
    }

    /**
     * Check if user has the specified role
     */
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    /**
     * Get the user's active premium status.
     */
    public function getHasActivePremiumAttribute(): bool
    {
        return $this->is_premium && $this->premium_expires_at && $this->premium_expires_at->isFuture();
    }

    /**
     * Get the user's active subscription transaction
     */
    public function activeSubscription(): HasOne
    {
        return $this->hasOne(SubscriptionTransaction::class)
            ->where('status', 'success')
            ->where('expired_at', '>', now())
            ->latest();
    }

    /**
     * Get the user's active subscription plan
     */
    public function getActiveSubscriptionPlanAttribute()
    {
        return $this->activeSubscription?->subscriptionPlan;
    }

    /**
     * Get the user's subscription status
     */
    public function getSubscriptionStatusAttribute(): array
    {
        // If user has no premium flag
        if (!$this->is_premium) {
            return [
                'name' => 'Free',
                'status' => 'inactive',
                'expires_at' => null,
                'daily_limit' => 5
            ];
        }

        // If premium expired
        if ($this->premium_expires_at < now()) {
            return [
                'name' => 'Free',
                'status' => 'expired',
                'expires_at' => $this->premium_expires_at,
                'daily_limit' => 5
            ];
        }

        // Get active subscription
        $activeSubscription = $this->activeSubscription;
        if (!$activeSubscription) {
            return [
                'name' => 'Free',
                'status' => 'inactive',
                'expires_at' => null,
                'daily_limit' => 5
            ];
        }

        // Return active subscription details
        $plan = $activeSubscription->subscriptionPlan;
        $limits = [
            'Paket Basic' => 15,
            'Paket Professional' => 30,
            'Paket Ultimate' => PHP_INT_MAX
        ];

        return [
            'name' => $plan->name,
            'status' => 'active',
            'expires_at' => $activeSubscription->expired_at,
            'daily_limit' => $limits[$plan->name] ?? 5
        ];
    }

    /**
     * Get daily application limit based on subscription
     */
    public function getDailyApplicationLimitAttribute(): int
    {
        return $this->subscription_status['daily_limit'];
    }

    /**
     * Check if user has reached daily application limit
     */
    public function hasReachedDailyApplicationLimit(): bool
    {
        $todayApplicationCount = $this->jobApplications()
            ->whereDate('created_at', today())
            ->count();

        return $todayApplicationCount >= $this->daily_application_limit;
    }

    /**
     * Get remaining applications for today
     */
    public function getRemainingApplicationsAttribute(): int
    {
        $todayApplicationCount = $this->jobApplications()
            ->whereDate('created_at', today())
            ->count();

        return max(0, $this->daily_application_limit - $todayApplicationCount);
    }
}
