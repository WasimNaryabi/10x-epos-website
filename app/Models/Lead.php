<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Lead extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'company_name',
        'business_type',
        'message',
        'source',
        'status',
        'priority',
        'lead_score',
        'assigned_to',
        'converted_to_customer_id',
        'converted_at',
        'last_contacted_at',
        'next_follow_up_at',
        'notes',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'referrer_url',
        'ip_address',
    ];

    protected $casts = [
        'converted_at' => 'datetime',
        'last_contacted_at' => 'datetime',
        'next_follow_up_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $appends = [
        'status_badge_class',
        'priority_badge_class',
        'is_overdue',
    ];

    // Activity Log
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['status', 'priority', 'assigned_to', 'notes'])
            ->logOnlyDirty();
    }

    // Relationships
    public function convertedToCustomer()
    {
        return $this->belongsTo(Customer::class, 'converted_to_customer_id');
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function demoRequests()
    {
        return $this->hasMany(DemoRequest::class);
    }

    // Scopes
    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }

    public function scopeQualified($query)
    {
        return $query->where('status', 'qualified');
    }

    public function scopeConverted($query)
    {
        return $query->whereNotNull('converted_to_customer_id');
    }

    public function scopeNotConverted($query)
    {
        return $query->whereNull('converted_to_customer_id');
    }

    public function scopeHighPriority($query)
    {
        return $query->whereIn('priority', ['high', 'urgent']);
    }

    public function scopeOverdue($query)
    {
        return $query->where('next_follow_up_at', '<', now())
                     ->whereNotNull('next_follow_up_at')
                     ->whereNull('converted_to_customer_id');
    }

    public function scopeBySource($query, $source)
    {
        return $query->where('source', $source);
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
    public function getStatusBadgeClassAttribute()
    {
        return match($this->status) {
            'new' => 'bg-blue-100 text-blue-800',
            'contacted' => 'bg-purple-100 text-purple-800',
            'qualified' => 'bg-indigo-100 text-indigo-800',
            'demo_scheduled' => 'bg-cyan-100 text-cyan-800',
            'proposal_sent' => 'bg-yellow-100 text-yellow-800',
            'negotiation' => 'bg-orange-100 text-orange-800',
            'won' => 'bg-green-100 text-green-800',
            'lost' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function getPriorityBadgeClassAttribute()
    {
        return match($this->priority) {
            'low' => 'bg-gray-100 text-gray-800',
            'medium' => 'bg-blue-100 text-blue-800',
            'high' => 'bg-orange-100 text-orange-800',
            'urgent' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function getIsOverdueAttribute()
    {
        if (!$this->next_follow_up_at || $this->converted_to_customer_id) {
            return false;
        }

        return $this->next_follow_up_at->isPast();
    }

    // Methods
    public function calculateLeadScore()
    {
        $score = 0;

        // Score based on business type
        if (in_array($this->business_type, ['chain', 'fine-dining'])) {
            $score += 20;
        } elseif (in_array($this->business_type, ['restaurant'])) {
            $score += 15;
        }

        // Score based on contact information completeness
        if ($this->phone) $score += 10;
        if ($this->company_name) $score += 10;
        if ($this->message) $score += 5;

        // Score based on source
        if ($this->source === 'referral') $score += 15;
        if ($this->source === 'demo_request') $score += 20;

        // Score based on activity
        if ($this->last_contacted_at) $score += 10;

        // Score based on demo requests
        $demoRequestCount = $this->demoRequests()->count();
        $score += min($demoRequestCount * 10, 30);

        $this->lead_score = min($score, 100);
        $this->save();

        return $this->lead_score;
    }

    public function convertToCustomer()
    {
        $customer = Customer::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'company_name' => $this->company_name,
            'business_type' => $this->business_type,
            'notes' => $this->notes,
            'source' => $this->source,
            'status' => 'trial',
            'subscription_status' => 'trial',
        ]);

        $this->converted_to_customer_id = $customer->id;
        $this->converted_at = now();
        $this->status = 'won';
        $this->save();

        return $customer;
    }

    // Static Methods
    public static function getStatuses()
    {
        return [
            'new' => 'New',
            'contacted' => 'Contacted',
            'qualified' => 'Qualified',
            'demo_scheduled' => 'Demo Scheduled',
            'proposal_sent' => 'Proposal Sent',
            'negotiation' => 'Negotiation',
            'won' => 'Won',
            'lost' => 'Lost',
        ];
    }

    public static function getPriorities()
    {
        return [
            'low' => 'Low',
            'medium' => 'Medium',
            'high' => 'High',
            'urgent' => 'Urgent',
        ];
    }

    public static function getSources()
    {
        return [
            'website_contact' => 'Website Contact',
            'demo_request' => 'Demo Request',
            'referral' => 'Referral',
            'social_media' => 'Social Media',
            'email_campaign' => 'Email Campaign',
            'phone_call' => 'Phone Call',
            'other' => 'Other',
        ];
    }
}