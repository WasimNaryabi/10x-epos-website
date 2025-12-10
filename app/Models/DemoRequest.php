<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Str;

class DemoRequest extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'company_name',
        'business_type',
        'preferred_date',
        'preferred_time',
        'demo_type',
        'status',
        'scheduled_at',
        'completed_at',
        'meeting_link',
        'notes',
        'admin_notes',
        'assigned_to',
        'lead_id',
        'customer_id',
        'follow_up_sent',
        'follow_up_sent_at',
        'utm_source',
        'utm_campaign',
        'ip_address',
    ];

    protected $casts = [
        'preferred_date' => 'date',
        'preferred_time' => 'datetime',
        'scheduled_at' => 'datetime',
        'completed_at' => 'datetime',
        'follow_up_sent' => 'boolean',
        'follow_up_sent_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $appends = [
        'status_badge_class',
        'demo_type_label',
        'is_overdue',
        'is_upcoming',
        'formatted_scheduled_time',
    ];

    // Activity Log Configuration
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['status', 'scheduled_at', 'assigned_to', 'notes'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    // Relationships
    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeScheduled($query)
    {
        return $query->where('status', 'scheduled');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    public function scopeNoShow($query)
    {
        return $query->where('status', 'no-show');
    }

    public function scopeUpcoming($query)
    {
        return $query->where('status', 'scheduled')
                     ->where('scheduled_at', '>=', now())
                     ->orderBy('scheduled_at');
    }

    public function scopeOverdue($query)
    {
        return $query->where('status', 'scheduled')
                     ->where('scheduled_at', '<', now());
    }

    public function scopeByDemoType($query, $type)
    {
        return $query->where('demo_type', $type);
    }

    public function scopeByBusinessType($query, $type)
    {
        return $query->where('business_type', $type);
    }

    public function scopeNeedingFollowUp($query)
    {
        return $query->where('status', 'completed')
                     ->where('follow_up_sent', false);
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
            'pending' => 'bg-yellow-100 text-yellow-800',
            'scheduled' => 'bg-blue-100 text-blue-800',
            'completed' => 'bg-green-100 text-green-800',
            'cancelled' => 'bg-red-100 text-red-800',
            'no-show' => 'bg-gray-100 text-gray-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function getDemoTypeLabelAttribute()
    {
        return match($this->demo_type) {
            'online' => 'Online Demo',
            'in-person' => 'In-Person Demo',
            'phone' => 'Phone Call',
            default => 'Unknown',
        };
    }

    public function getIsOverdueAttribute()
    {
        if ($this->status !== 'scheduled' || !$this->scheduled_at) {
            return false;
        }

        return $this->scheduled_at->isPast();
    }

    public function getIsUpcomingAttribute()
    {
        if ($this->status !== 'scheduled' || !$this->scheduled_at) {
            return false;
        }

        return $this->scheduled_at->isFuture() && 
               $this->scheduled_at->diffInDays(now()) <= 7;
    }

    public function getFormattedScheduledTimeAttribute()
    {
        if (!$this->scheduled_at) {
            return null;
        }

        return $this->scheduled_at->format('l, F j, Y \a\t g:i A');
    }

    // Methods
    public function schedule($datetime, $meetingLink = null, $assignedTo = null)
    {
        $this->status = 'scheduled';
        $this->scheduled_at = $datetime;
        
        if ($meetingLink) {
            $this->meeting_link = $meetingLink;
        }
        
        if ($assignedTo) {
            $this->assigned_to = $assignedTo;
        }

        $this->save();

        // Send confirmation email
        // Mail::to($this->email)->send(new DemoScheduledMail($this));

        return $this;
    }

    public function complete($notes = null)
    {
        $this->status = 'completed';
        $this->completed_at = now();
        
        if ($notes) {
            $this->admin_notes = $notes;
        }

        $this->save();

        return $this;
    }

    public function cancel($reason = null)
    {
        $this->status = 'cancelled';
        
        if ($reason) {
            $this->admin_notes = ($this->admin_notes ? $this->admin_notes . "\n\n" : '') . 
                                "Cancelled: " . $reason;
        }

        $this->save();

        return $this;
    }

    public function markAsNoShow()
    {
        $this->status = 'no-show';
        $this->save();

        return $this;
    }

    public function reschedule($newDatetime)
    {
        $this->scheduled_at = $newDatetime;
        $this->save();

        // Send reschedule notification
        // Mail::to($this->email)->send(new DemoRescheduledMail($this));

        return $this;
    }

    public function sendFollowUp()
    {
        if ($this->status !== 'completed') {
            return false;
        }

        // Send follow-up email
        // Mail::to($this->email)->send(new DemoFollowUpMail($this));

        $this->follow_up_sent = true;
        $this->follow_up_sent_at = now();
        $this->save();

        return true;
    }

    public function assignTo($userId)
    {
        $this->assigned_to = $userId;
        $this->save();

        return $this;
    }

    public function linkToLead($leadId)
    {
        $this->lead_id = $leadId;
        $this->save();

        return $this;
    }

    public function linkToCustomer($customerId)
    {
        $this->customer_id = $customerId;
        $this->save();

        return $this;
    }

    public function generateMeetingLink($platform = 'zoom')
{
    $link = match($platform) {
        'zoom' => 'https://zoom.us/j/' . rand(1000000000, 9999999999),
        'meet' => 'https://meet.google.com/' . Str::random(10),
        'teams' => 'https://teams.microsoft.com/l/meetup-join/' . Str::random(20),
        default => null,
    };

    if ($link) {
        $this->meeting_link = $link;
        $this->save();
    }

    return $link;
}

    public function getTimeUntilDemo()
    {
        if (!$this->scheduled_at) {
            return null;
        }

        if ($this->scheduled_at->isPast()) {
            return 'Overdue';
        }

        return $this->scheduled_at->diffForHumans();
    }

    public function getDuration()
    {
        if (!$this->completed_at || !$this->scheduled_at) {
            return null;
        }

        return $this->scheduled_at->diffInMinutes($this->completed_at);
    }

    // Static Methods
    public static function getStatuses()
    {
        return [
            'pending' => 'Pending',
            'scheduled' => 'Scheduled',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled',
            'no-show' => 'No Show',
        ];
    }

    public static function getDemoTypes()
    {
        return [
            'online' => 'Online Demo',
            'in-person' => 'In-Person Demo',
            'phone' => 'Phone Call',
        ];
    }

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

    public static function getTodaysDemos()
    {
        return self::scheduled()
            ->whereDate('scheduled_at', today())
            ->orderBy('scheduled_at')
            ->get();
    }

    public static function getUpcomingDemos($days = 7)
    {
        return self::scheduled()
            ->whereBetween('scheduled_at', [now(), now()->addDays($days)])
            ->orderBy('scheduled_at')
            ->get();
    }

    public static function getConversionRate()
    {
        $completed = self::completed()->count();
        $total = self::whereIn('status', ['completed', 'no-show'])->count();

        if ($total === 0) {
            return 0;
        }

        return round(($completed / $total) * 100, 1);
    }
}