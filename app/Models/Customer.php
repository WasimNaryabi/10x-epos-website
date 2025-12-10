<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Customer extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'company_name',
        'business_type',
        'business_description',
        'address_line_1',
        'address_line_2',
        'city',
        'state',
        'postal_code',
        'country',
        'subscription_plan',
        'subscription_status',
        'subscription_start_date',
        'subscription_end_date',
        'monthly_fee',
        'number_of_locations',
        'number_of_terminals',
        'notes',
        'status',
        'source',
        'assigned_sales_rep',
        'last_login_at',
    ];

    protected $casts = [
        'subscription_start_date' => 'date',
        'subscription_end_date' => 'date',
        'last_login_at' => 'datetime',
        'monthly_fee' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $appends = [
        'full_address',
        'status_badge_class',
        'subscription_status_badge_class',
    ];

    // Activity Log Configuration
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'email', 'status', 'subscription_status', 'subscription_plan'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    // Relationships
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function activeSubscription()
    {
        return $this->hasOne(Subscription::class)->where('status', 'active')->latest();
    }

    public function demoRequests()
    {
        return $this->hasMany(DemoRequest::class);
    }

    public function convertedFromLead()
    {
        return $this->hasOne(Lead::class, 'converted_to_customer_id');
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

    public function scopeChurned($query)
    {
        return $query->where('status', 'churned');
    }

    public function scopeByBusinessType($query, $type)
    {
        return $query->where('business_type', $type);
    }

    public function scopeBySubscriptionPlan($query, $plan)
    {
        return $query->where('subscription_plan', $plan);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('company_name', 'like', "%{$search}%")
              ->orWhere('phone', 'like', "%{$search}%");
        });
    }

    // Accessors
    public function getFullAddressAttribute()
    {
        $parts = array_filter([
            $this->address_line_1,
            $this->address_line_2,
            $this->city,
            $this->state,
            $this->postal_code,
            $this->country,
        ]);

        return implode(', ', $parts);
    }

    public function getStatusBadgeClassAttribute()
    {
        return match($this->status) {
            'lead' => 'bg-gray-100 text-gray-800',
            'trial' => 'bg-blue-100 text-blue-800',
            'active' => 'bg-green-100 text-green-800',
            'churned' => 'bg-red-100 text-red-800',
            'inactive' => 'bg-yellow-100 text-yellow-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function getSubscriptionStatusBadgeClassAttribute()
    {
        return match($this->subscription_status) {
            'active' => 'bg-green-100 text-green-800',
            'trial' => 'bg-blue-100 text-blue-800',
            'cancelled' => 'bg-red-100 text-red-800',
            'expired' => 'bg-gray-100 text-gray-800',
            'pending' => 'bg-yellow-100 text-yellow-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    // Methods
    public function calculateLifetimeValue()
    {
        return $this->subscriptions()
            ->where('status', 'active')
            ->sum('price');
    }

    public function isSubscriptionActive()
    {
        return $this->subscription_status === 'active';
    }

    public function canAccessFeature($feature)
    {
        // Check if customer's plan includes the feature
        $subscription = $this->activeSubscription;
        
        if (!$subscription) {
            return false;
        }

        $features = $subscription->features ?? [];
        return in_array($feature, $features);
    }

    // Static Methods
    public static function getBusinessTypes()
    {
        return [
            'cafe' => 'Cafe',
            'restaurant' => 'Restaurant',
            'fast-food' => 'Fast Food',
            'fine-dining' => 'Fine Dining',
            'chain' => 'Chain/Franchise',
            'other' => 'Other',
        ];
    }

    public static function getStatuses()
    {
        return [
            'lead' => 'Lead',
            'trial' => 'Trial',
            'active' => 'Active',
            'churned' => 'Churned',
            'inactive' => 'Inactive',
        ];
    }

    public static function getSubscriptionStatuses()
    {
        return [
            'active' => 'Active',
            'trial' => 'Trial',
            'cancelled' => 'Cancelled',
            'expired' => 'Expired',
            'pending' => 'Pending',
        ];
    }
}