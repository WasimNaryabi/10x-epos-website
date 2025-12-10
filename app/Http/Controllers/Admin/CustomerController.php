<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CustomerController extends Controller
{
    /**
     * Display a listing of customers
     */
    public function index(Request $request): Response
    {
        $query = Customer::query();

        // Search
        if ($search = $request->input('search')) {
            $query->search($search);
        }

        // Filter by status
        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        // Filter by subscription plan
        if ($plan = $request->input('plan')) {
            $query->where('subscription_plan', $plan);
        }

        // Filter by business type
        if ($businessType = $request->input('business_type')) {
            $query->where('business_type', $businessType);
        }

        // Sort
        $sortField = $request->input('sort_field', 'created_at');
        $sortOrder = $request->input('sort_order', 'desc');
        $query->orderBy($sortField, $sortOrder);

        $customers = $query->with(['activeSubscription'])
            ->paginate(20)
            ->withQueryString();

        return Inertia::render('Admin/Customers/Index', [
            'customers' => $customers,
            'filters' => $request->only(['search', 'status', 'plan', 'business_type']),
            'statuses' => Customer::getStatuses(),
            'plans' => ['starter' => 'Starter', 'professional' => 'Professional', 'enterprise' => 'Enterprise'],
            'businessTypes' => Customer::getBusinessTypes(),
        ]);
    }

    /**
     * Display the specified customer
     */
    public function show(Customer $customer): Response
    {
        $customer->load([
            'subscriptions',
            'demoRequests',
            'convertedFromLead',
        ]);

        $activities = $customer->activities()
            ->latest()
            ->limit(20)
            ->get();

        return Inertia::render('Admin/Customers/Show', [
            'customer' => [
                'id' => $customer->id,
                'name' => $customer->name,
                'email' => $customer->email,
                'phone' => $customer->phone,
                'company_name' => $customer->company_name,
                'business_type' => $customer->business_type,
                'business_description' => $customer->business_description,
                'full_address' => $customer->full_address,
                'subscription_plan' => $customer->subscription_plan,
                'subscription_status' => $customer->subscription_status,
                'subscription_start_date' => $customer->subscription_start_date?->format('Y-m-d'),
                'subscription_end_date' => $customer->subscription_end_date?->format('Y-m-d'),
                'monthly_fee' => $customer->monthly_fee,
                'number_of_locations' => $customer->number_of_locations,
                'number_of_terminals' => $customer->number_of_terminals,
                'notes' => $customer->notes,
                'status' => $customer->status,
                'source' => $customer->source,
                'created_at' => $customer->created_at->format('M d, Y'),
                'lifetime_value' => $customer->calculateLifetimeValue(),
                'status_badge_class' => $customer->status_badge_class,
                'subscription_status_badge_class' => $customer->subscription_status_badge_class,
            ],
            'subscriptions' => $customer->subscriptions->map(function ($sub) {
                return [
                    'id' => $sub->id,
                    'plan_name' => $sub->plan_name,
                    'price' => $sub->price,
                    'billing_cycle' => $sub->billing_cycle,
                    'status' => $sub->status,
                    'start_date' => $sub->start_date->format('M d, Y'),
                    'end_date' => $sub->end_date?->format('M d, Y'),
                ];
            }),
            'activities' => $activities->map(function ($activity) {
                return [
                    'description' => $activity->description,
                    'created_at' => $activity->created_at->diffForHumans(),
                ];
            }),
        ]);
    }

    /**
     * Show the form for editing the specified customer
     */
    public function edit(Customer $customer): Response
    {
        return Inertia::render('Admin/Customers/Edit', [
            'customer' => $customer,
            'statuses' => Customer::getStatuses(),
            'subscriptionStatuses' => Customer::getSubscriptionStatuses(),
            'plans' => ['starter' => 'Starter', 'professional' => 'Professional', 'enterprise' => 'Enterprise'],
            'businessTypes' => Customer::getBusinessTypes(),
        ]);
    }

    /**
     * Update the specified customer
     */
    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'phone' => 'nullable|string|max:20',
            'company_name' => 'nullable|string|max:255',
            'business_type' => 'nullable|in:cafe,restaurant,fast-food,fine-dining,chain,other',
            'business_description' => 'nullable|string',
            'address_line_1' => 'nullable|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
            'subscription_plan' => 'nullable|in:starter,professional,enterprise',
            'subscription_status' => 'required|in:active,trial,cancelled,expired,pending',
            'subscription_start_date' => 'nullable|date',
            'subscription_end_date' => 'nullable|date|after:subscription_start_date',
            'monthly_fee' => 'nullable|numeric|min:0',
            'number_of_locations' => 'nullable|integer|min:1',
            'number_of_terminals' => 'nullable|integer|min:1',
            'notes' => 'nullable|string',
            'status' => 'required|in:lead,trial,active,churned,inactive',
        ]);

        $customer->update($validated);

        return redirect()
            ->route('admin.customers.show', $customer)
            ->with('success', 'Customer updated successfully.');
    }

    /**
     * Remove the specified customer
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()
            ->route('admin.customers.index')
            ->with('success', 'Customer deleted successfully.');
    }

    /**
     * Export customers to CSV
     */
    public function export(Request $request)
    {
        $query = Customer::query();

        // Apply same filters as index
        if ($search = $request->input('search')) {
            $query->search($search);
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        if ($plan = $request->input('plan')) {
            $query->where('subscription_plan', $plan);
        }

        $customers = $query->get();

        $filename = 'customers_' . now()->format('Y-m-d_His') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function() use ($customers) {
            $file = fopen('php://output', 'w');
            
            // Headers
            fputcsv($file, [
                'ID', 'Name', 'Email', 'Phone', 'Company', 'Business Type',
                'Status', 'Subscription Plan', 'Subscription Status', 'Monthly Fee',
                'Created At'
            ]);

            // Data
            foreach ($customers as $customer) {
                fputcsv($file, [
                    $customer->id,
                    $customer->name,
                    $customer->email,
                    $customer->phone,
                    $customer->company_name,
                    $customer->business_type,
                    $customer->status,
                    $customer->subscription_plan,
                    $customer->subscription_status,
                    $customer->monthly_fee,
                    $customer->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}