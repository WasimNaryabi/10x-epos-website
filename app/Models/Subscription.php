<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Carbon\Carbon;

class Subscription extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = [
        'customer_id',
        'plan_name',
        'price',
        'billing_cycle',
        'status',
        'start_date',
        'end_date',
        'trial_ends_at',
        'next_billing_date',
        'cancelled_at',
        'payment_method',
        'stripe_subscription_id',
        'stripe_customer_id',
        'features',
        'max_terminals',
        'max_users',
        'advanced_reporting',
        'api_access',
        'priority_support',
        'notes',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'trial_ends_at' => 'date',
        'next_billing_date' => 'date',
        'cancelled_at' => 'datetime',
        'price' => 'decimal:2',
        'features' => 'array',
        'max_terminals' => 'integer',
        'max_users' => 'integer',
        'advanced_reporting' => 'boolean',
        'api_access' => 'boolean',
        'priority_support' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $appends = [
        'status_badge_class',
        'is_active',
        'is_trial',
        'is_cancelled',
        'days_until_renewal',
        'monthly_amount',
    ];

    // Activity Log Configuration
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['status', 'plan_name', 'price', 'billing_cycle'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    // Relationships
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeTrial($query)
    {
        return $query->where('status', 'trial');
    }

    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    public function scopeExpired($query)
    {
        return $query->where('status', 'expired');
    }

    public function scopeByPlan($query, $plan)
    {
        return $query->where('plan_name', $plan);
    }

    public function scopeMonthly($query)
    {
        return $query->where('billing_cycle', 'monthly');
    }

    public function scopeYearly($query)
    {
        return $query->where('billing_cycle', 'yearly');
    }

    public function scopeDueForRenewal($query, $days = 7)
    {
        return $query->where('status', 'active')
                     ->whereNotNull('next_billing_date')
                     ->where('next_billing_date', '<=', now()->addDays($days))
                     ->where('next_billing_date', '>=', now());
    }

    public function scopeTrialExpiringSoon($query, $days = 7)
    {
        return $query->where('status', 'trial')
                     ->whereNotNull('trial_ends_at')
                     ->where('trial_ends_at', '<=', now()->addDays($days))
                     ->where('trial_ends_at', '>=', now());
    }

    // Accessors
    public function getStatusBadgeClassAttribute()
    {
        return match($this->status) {
            'active' => 'bg-green-100 text-green-800',
            'trial' => 'bg-blue-100 text-blue-800',
            'cancelled' => 'bg-red-100 text-red-800',
            'expired' => 'bg-gray-100 text-gray-800',
            'suspended' => 'bg-yellow-100 text-yellow-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function getIsActiveAttribute()
    {
        return $this->status === 'active';
    }

    public function getIsTrialAttribute()
    {
        return $this->status === 'trial';
    }

    public function getIsCancelledAttribute()
    {
        return $this->status === 'cancelled';
    }

    public function getDaysUntilRenewalAttribute()
    {
        if (!$this->next_billing_date) {
            return null;
        }

        $days = now()->diffInDays($this->next_billing_date, false);
        return $days >= 0 ? $days : 0;
    }

    public function getMonthlyAmountAttribute()
    {
        if ($this->billing_cycle === 'monthly') {
            return $this->price;
        }

        // For yearly, calculate monthly equivalent
        return round($this->price / 12, 2);
    }

    // Methods
    public function activate()
    {
        $this->status = 'active';
        $this->start_date = now();
        
        // Set next billing date
        if ($this->billing_cycle === 'monthly') {
            $this->next_billing_date = now()->addMonth();
        } else {
            $this->next_billing_date = now()->addYear();
        }

        $this->save();

        return $this;
    }

    public function cancel($immediately = false)
    {
        if ($immediately) {
            $this->status = 'cancelled';
            $this->end_date = now();
        } else {
            // Cancel at end of billing period
            $this->status = 'cancelled';
            $this->end_date = $this->next_billing_date;
        }

        $this->cancelled_at = now();
        $this->save();

        return $this;
    }

    public function suspend()
    {
        $this->status = 'suspended';
        $this->save();

        return $this;
    }

    public function renew()
    {
        if ($this->status !== 'active') {
            return false;
        }

        // Calculate next billing date
        if ($this->billing_cycle === 'monthly') {
            $this->next_billing_date = $this->next_billing_date->addMonth();
        } else {
            $this->next_billing_date = $this->next_billing_date->addYear();
        }

        $this->save();

        return $this;
    }

    public function changePlan($newPlan, $newPrice)
    {
        $this->plan_name = $newPlan;
        $this->price = $newPrice;
        $this->save();

        return $this;
    }

    public function isFeatureEnabled($feature)
    {
        $features = $this->features ?? [];
        return in_array($feature, $features);
    }

    public function hasAccessToTerminals($count)
    {
        return $count <= $this->max_terminals;
    }

    public function hasAccessToUsers($count)
    {
        return $count <= $this->max_users;
    }

    public function calculateProration($newPrice)
    {
        if (!$this->next_billing_date) {
            return 0;
        }

        $daysRemaining = now()->diffInDays($this->next_billing_date);
        $totalDays = $this->billing_cycle === 'monthly' ? 30 : 365;
        
        $unusedAmount = ($this->price / $totalDays) * $daysRemaining;
        $newAmount = ($newPrice / $totalDays) * $daysRemaining;

        return round($newAmount - $unusedAmount, 2);
    }

    public function getTotalRevenue()
    {
        // Calculate total revenue from this subscription
        if (!$this->start_date) {
            return 0;
        }

        $endDate = $this->end_date ?? now();
        $months = $this->start_date->diffInMonths($endDate);

        if ($this->billing_cycle === 'monthly') {
            return $months * $this->price;
        } else {
            // Yearly billing
            $years = floor($months / 12);
            return $years * $this->price;
        }
    }

    // Static Methods
    public static function getPlanFeatures($plan)
    {
        return match($plan) {
            'starter' => [
                'Basic Reporting',
                'Email Support',
                'Cloud Backup',
                'Inventory Management',
                'Table Management',
                'Payment Integration',
            ],
            'professional' => [
                'Advanced Reporting',
                'Priority Support',
                'Cloud Backup',
                'Inventory Management',
                'Table Management',
                'Payment Integration',
                'KOT System',
                'Multi-location Support',
                'API Access',
            ],
            'enterprise' => [
                'Advanced Analytics',
                '24/7 Priority Support',
                'Cloud Backup',
                'Inventory Management',
                'Table Management',
                'Payment Integration',
                'KOT System',
                'Multi-location Support',
                'API Access',
                'Custom Integration',
                'Dedicated Account Manager',
                'On-site Training',
            ],
            default => [],
        };
    }

    public static function getPlanPrice($plan, $cycle = 'monthly')
    {
        $prices = [
            'starter' => ['monthly' => 49, 'yearly' => 490],
            'professional' => ['monthly' => 99, 'yearly' => 990],
            'enterprise' => ['monthly' => 199, 'yearly' => 1990],
        ];

        return $prices[$plan][$cycle] ?? 0;
    }

    public static function getPlanLimits($plan)
    {
        return match($plan) {
            'starter' => [
                'max_terminals' => 1,
                'max_users' => 5,
                'max_locations' => 1,
                'advanced_reporting' => false,
                'api_access' => false,
                'priority_support' => false,
            ],
            'professional' => [
                'max_terminals' => 3,
                'max_users' => 999999, // Unlimited
                'max_locations' => 5,
                'advanced_reporting' => true,
                'api_access' => true,
                'priority_support' => true,
            ],
            'enterprise' => [
                'max_terminals' => 999999, // Unlimited
                'max_users' => 999999, // Unlimited
                'max_locations' => 999999, // Unlimited
                'advanced_reporting' => true,
                'api_access' => true,
                'priority_support' => true,
            ],
            default => [],
        };
    }

    public static function getStatuses()
    {
        return [
            'active' => 'Active',
            'trial' => 'Trial',
            'cancelled' => 'Cancelled',
            'expired' => 'Expired',
            'suspended' => 'Suspended',
        ];
    }

    public static function getBillingCycles()
    {
        return [
            'monthly' => 'Monthly',
            'yearly' => 'Yearly',
        ];
    }
}