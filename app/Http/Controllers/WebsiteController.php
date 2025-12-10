<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Lead;
use App\Mail\ContactFormSubmitted;
use App\Mail\ContactConfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use Inertia\Response;

class WebsiteController extends Controller
{
    /**
     * Display the homepage
     */
    public function index(): Response
    {
        return Inertia::render('Website/Home', [
            'stats' => $this->getWebsiteStats(),
        ]);
    }

    /**
     * Display features page
     */
    public function features(): Response
    {
        return Inertia::render('Website/Features');
    }

    /**
     * Display pricing page
     */
    public function pricing(): Response
    {
        $plans = [
            [
                'name' => 'Starter',
                'price' => '49',
                'billing' => 'month',
                'description' => 'Perfect for small cafes and startups',
                'features' => [
                    '1 Terminal',
                    '5 Staff Accounts',
                    'Basic Reporting',
                    'Email Support',
                    'Cloud Backup',
                    'Inventory Management',
                    'Table Management',
                    'Payment Integration',
                ],
                'popular' => false,
            ],
            [
                'name' => 'Professional',
                'price' => '99',
                'billing' => 'month',
                'description' => 'For growing restaurants',
                'features' => [
                    '3 Terminals',
                    'Unlimited Staff',
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
                'popular' => true,
            ],
            [
                'name' => 'Enterprise',
                'price' => '199',
                'billing' => 'month',
                'description' => 'For chains and large operations',
                'features' => [
                    'Unlimited Terminals',
                    'Unlimited Staff',
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
                'popular' => false,
            ],
        ];

        return Inertia::render('Website/Pricing', [
            'plans' => $plans,
        ]);
    }

    /**
     * Handle contact form submission
     */
    public function submitContact(ContactRequest $request)
    {
        try {
            // Create lead from contact form
            $lead = Lead::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'business_type' => $request->business_type,
                'message' => $request->message,
                'source' => 'website_contact',
                'status' => 'new',
                'priority' => 'medium',
                'ip_address' => $request->ip(),
                'utm_source' => $request->query('utm_source'),
                'utm_medium' => $request->query('utm_medium'),
                'utm_campaign' => $request->query('utm_campaign'),
                'referrer_url' => $request->header('referer'),
            ]);

            // Calculate lead score
            $lead->calculateLeadScore();

            // Send notification email to admin
            Mail::to(config('mail.admin_email', 'sales@10xglobalepos.com'))
                ->send(new ContactFormSubmitted($lead));

            // Send confirmation email to customer
            Mail::to($lead->email)
                ->send(new ContactConfirmation($lead));

            return back()->with('success', 'Thank you for contacting us! We\'ll get back to you within 24 hours.');

        } catch (\Exception $e) {
           // \Log::error('Contact form submission failed: ' . $e->getMessage());
            
            return back()->withErrors([
                'message' => 'Something went wrong. Please try again or contact us directly at sales@10xglobalepos.com'
            ]);
        }
    }

    /**
     * Get website statistics
     */
    private function getWebsiteStats(): array
    {
        return [
            'active_restaurants' => '500+',
            'daily_transactions' => '50,000+',
            'customer_satisfaction' => '99%',
            'uptime' => '99.9%',
        ];
    }
}