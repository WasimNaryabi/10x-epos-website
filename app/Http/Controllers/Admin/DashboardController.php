<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Lead;
use App\Models\DemoRequest;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display admin dashboard
     */
    public function index(): Response
    {
        $dateRange = request('date_range', 'last_30_days');
        $startDate = $this->getStartDate($dateRange);

        return Inertia::render('Admin/Dashboard', [
            'stats' => $this->getStats($startDate),
            'recentLeads' => $this->getRecentLeads(),
            'recentCustomers' => $this->getRecentCustomers(),
            'pendingDemos' => $this->getPendingDemos(),
            'revenueData' => $this->getRevenueData($startDate),
            'customerGrowth' => $this->getCustomerGrowth($startDate),
            'leadsBySource' => $this->getLeadsBySource($startDate),
            'subscriptionBreakdown' => $this->getSubscriptionBreakdown(),
        ]);
    }

    /**
     * Get key statistics
     */
    private function getStats($startDate): array
    {
        $previousPeriod = $startDate->copy()->subDays($startDate->diffInDays(now()));

        // Total customers
        $totalCustomers = Customer::count();
        $previousCustomers = Customer::where('created_at', '<', $startDate)->count();
        $customerGrowth = $this->calculateGrowth($totalCustomers, $previousCustomers);

        // Active subscriptions
        $activeSubscriptions = Customer::where('subscription_status', 'active')->count();
        $previousActive = Customer::where('subscription_status', 'active')
            ->where('subscription_start_date', '<', $startDate)
            ->count();
        $subscriptionGrowth = $this->calculateGrowth($activeSubscriptions, $previousActive);

        // Monthly Recurring Revenue
        $mrr = Customer::where('subscription_status', 'active')
            ->sum('monthly_fee');
        $previousMrr = Customer::where('subscription_status', 'active')
            ->where('subscription_start_date', '<', $startDate)
            ->sum('monthly_fee');
        $mrrGrowth = $this->calculateGrowth($mrr, $previousMrr);

        // New leads
        $newLeads = Lead::where('created_at', '>=', $startDate)->count();
        $previousLeads = Lead::whereBetween('created_at', [$previousPeriod, $startDate])->count();
        $leadGrowth = $this->calculateGrowth($newLeads, $previousLeads);

        // Conversion rate
        $convertedLeads = Lead::whereNotNull('converted_to_customer_id')
            ->where('created_at', '>=', $startDate)
            ->count();
        $conversionRate = $newLeads > 0 ? ($convertedLeads / $newLeads) * 100 : 0;

        return [
            'total_customers' => [
                'value' => $totalCustomers,
                'growth' => $customerGrowth,
                'label' => 'Total Customers',
                'icon' => 'users',
            ],
            'active_subscriptions' => [
                'value' => $activeSubscriptions,
                'growth' => $subscriptionGrowth,
                'label' => 'Active Subscriptions',
                'icon' => 'check-circle',
            ],
            'mrr' => [
                'value' => '£' . number_format($mrr, 0),
                'growth' => $mrrGrowth,
                'label' => 'Monthly Recurring Revenue',
                'icon' => 'pound-sign',
            ],
            'new_leads' => [
                'value' => $newLeads,
                'growth' => $leadGrowth,
                'label' => 'New Leads',
                'icon' => 'user-plus',
            ],
            'conversion_rate' => [
                'value' => number_format($conversionRate, 1) . '%',
                'growth' => 0,
                'label' => 'Lead Conversion Rate',
                'icon' => 'chart-line',
            ],
        ];
    }

    /**
     * Get recent leads
     */
    private function getRecentLeads()
    {
        return Lead::with('assignedUser')
            ->latest()
            ->limit(5)
            ->get()
            ->map(function ($lead) {
                return [
                    'id' => $lead->id,
                    'name' => $lead->name,
                    'email' => $lead->email,
                    'company_name' => $lead->company_name,
                    'status' => $lead->status,
                    'priority' => $lead->priority,
                    'created_at' => $lead->created_at->diffForHumans(),
                    'status_badge_class' => $lead->status_badge_class,
                    'priority_badge_class' => $lead->priority_badge_class,
                ];
            });
    }

    /**
     * Get recent customers
     */
    private function getRecentCustomers()
    {
        return Customer::latest()
            ->limit(5)
            ->get()
            ->map(function ($customer) {
                return [
                    'id' => $customer->id,
                    'name' => $customer->name,
                    'email' => $customer->email,
                    'company_name' => $customer->company_name,
                    'subscription_plan' => $customer->subscription_plan,
                    'status' => $customer->status,
                    'created_at' => $customer->created_at->diffForHumans(),
                    'status_badge_class' => $customer->status_badge_class,
                ];
            });
    }

    /**
     * Get pending demo requests
     */
    private function getPendingDemos()
    {
        return DemoRequest::where('status', 'pending')
            ->orWhere('status', 'scheduled')
            ->orderBy('preferred_date')
            ->limit(5)
            ->get()
            ->map(function ($demo) {
                return [
                    'id' => $demo->id,
                    'name' => $demo->name,
                    'email' => $demo->email,
                    'preferred_date' => $demo->preferred_date?->format('M d, Y'),
                    'status' => $demo->status,
                    'created_at' => $demo->created_at->diffForHumans(),
                ];
            });
    }

    /**
     * Get revenue data for chart
     */
    private function getRevenueData($startDate): array
    {
        $days = $startDate->diffInDays(now());
        $data = [];

        for ($i = 0; $i <= $days; $i++) {
            $date = $startDate->copy()->addDays($i);
            
            $revenue = Customer::where('subscription_status', 'active')
                ->where('subscription_start_date', '<=', $date)
                ->sum('monthly_fee');

            $data[] = [
                'date' => $date->format('Y-m-d'),
                'label' => $date->format('M d'),
                'revenue' => $revenue,
            ];
        }

        return $data;
    }

    /**
     * Get customer growth data
     */
    private function getCustomerGrowth($startDate): array
    {
        $days = $startDate->diffInDays(now());
        $data = [];

        for ($i = 0; $i <= $days; $i++) {
            $date = $startDate->copy()->addDays($i);
            
            $total = Customer::where('created_at', '<=', $date)->count();

            $data[] = [
                'date' => $date->format('Y-m-d'),
                'label' => $date->format('M d'),
                'total' => $total,
            ];
        }

        return $data;
    }

    /**
     * Get leads by source
     */
    private function getLeadsBySource($startDate): array
    {
        $sources = Lead::where('created_at', '>=', $startDate)
            ->selectRaw('source, count(*) as count')
            ->groupBy('source')
            ->get();

        return $sources->map(function ($item) {
            return [
                'name' => ucwords(str_replace('_', ' ', $item->source)),
                'value' => $item->count,
            ];
        })->toArray();
    }

    /**
     * Get subscription breakdown
     */
    private function getSubscriptionBreakdown(): array
    {
        $breakdown = Customer::where('subscription_status', 'active')
            ->selectRaw('subscription_plan, count(*) as count')
            ->groupBy('subscription_plan')
            ->get();

        return $breakdown->map(function ($item) {
            return [
                'name' => ucfirst($item->subscription_plan),
                'value' => $item->count,
            ];
        })->toArray();
    }

    /**
     * Calculate growth percentage
     */
    private function calculateGrowth($current, $previous): float
    {
        if ($previous == 0) {
            return $current > 0 ? 100 : 0;
        }

        return round((($current - $previous) / $previous) * 100, 1);
    }

    /**
     * Get start date based on range
     */
    private function getStartDate($range): Carbon
    {
        return match($range) {
            'today' => now()->startOfDay(),
            'last_7_days' => now()->subDays(7),
            'last_30_days' => now()->subDays(30),
            'last_90_days' => now()->subDays(90),
            'this_month' => now()->startOfMonth(),
            'last_month' => now()->subMonth()->startOfMonth(),
            default => now()->subDays(30),
        };
    }
}