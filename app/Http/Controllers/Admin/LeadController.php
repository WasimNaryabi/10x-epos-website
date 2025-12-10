<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class LeadController extends Controller
{
    /**
     * Display a listing of leads
     */
    public function index(Request $request): Response
    {
        $query = Lead::query()->with(['assignedUser', 'convertedToCustomer']);

        // Search
        if ($search = $request->input('search')) {
            $query->search($search);
        }

        // Filter by status
        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        // Filter by priority
        if ($priority = $request->input('priority')) {
            $query->where('priority', $priority);
        }

        // Filter by source
        if ($source = $request->input('source')) {
            $query->where('source', $source);
        }

        // Sort
        $sortField = $request->input('sort_field', 'created_at');
        $sortOrder = $request->input('sort_order', 'desc');
        $query->orderBy($sortField, $sortOrder);

        $leads = $query->paginate(20)->withQueryString();

        // Get statistics
        $stats = [
            'total' => Lead::count(),
            'new' => Lead::new()->count(),
            'qualified' => Lead::qualified()->count(),
            'converted' => Lead::converted()->count(),
            'high_priority' => Lead::highPriority()->count(),
        ];

        return Inertia::render('Admin/Leads/Index', [
            'leads' => $leads,
            'stats' => $stats,
            'filters' => $request->only(['search', 'status', 'priority', 'source']),
            'statuses' => Lead::getStatuses(),
            'priorities' => Lead::getPriorities(),
            'sources' => Lead::getSources(),
        ]);
    }

    /**
     * Display the specified lead
     */
    public function show(Lead $lead): Response
    {
        $lead->load(['assignedUser', 'convertedToCustomer', 'demoRequests']);

        return Inertia::render('Admin/Leads/Show', [
            'lead' => $lead,
        ]);
    }

    /**
     * Update the specified lead
     */
    public function update(Request $request, Lead $lead)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'status' => 'required|string',
            'priority' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $lead->update($validated);

        return redirect()
            ->route('admin.leads.show', $lead)
            ->with('success', 'Lead updated successfully.');
    }

    /**
     * Convert lead to customer
     */
    public function convert(Lead $lead)
    {
        if ($lead->converted_to_customer_id) {
            return redirect()
                ->back()
                ->withErrors(['message' => 'Lead already converted.']);
        }

        $customer = $lead->convertToCustomer();

        return redirect()
            ->route('admin.customers.show', $customer)
            ->with('success', 'Lead converted to customer successfully!');
    }

    /**
     * Assign lead to user
     */
    public function assign(Request $request, Lead $lead)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $lead->assigned_to = $validated['user_id'];
        $lead->save();

        return redirect()
            ->route('admin.leads.show', $lead)
            ->with('success', 'Lead assigned successfully.');
    }

    /**
     * Export leads to CSV
     */
    public function export(Request $request)
    {
        $query = Lead::query();

        if ($search = $request->input('search')) {
            $query->search($search);
        }

        $leads = $query->get();

        $filename = 'leads_' . now()->format('Y-m-d_His') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function() use ($leads) {
            $file = fopen('php://output', 'w');
            
            fputcsv($file, [
                'ID', 'Name', 'Email', 'Phone', 'Company', 'Business Type',
                'Source', 'Status', 'Priority', 'Lead Score', 'Created At'
            ]);

            foreach ($leads as $lead) {
                fputcsv($file, [
                    $lead->id,
                    $lead->name,
                    $lead->email,
                    $lead->phone,
                    $lead->company_name,
                    $lead->business_type,
                    $lead->source,
                    $lead->status,
                    $lead->priority,
                    $lead->lead_score,
                    $lead->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}