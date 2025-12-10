<?php

use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\DemoRequestController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Public Website Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [WebsiteController::class, 'index'])->name('home');
Route::get('/features', [WebsiteController::class, 'features'])->name('features');
Route::get('/pricing', [WebsiteController::class, 'pricing'])->name('pricing');

// Contact & Demo Forms
Route::post('/contact', [WebsiteController::class, 'submitContact'])->name('contact.submit');
Route::post('/demo-request', [WebsiteController::class, 'submitDemoRequest'])->name('demo.submit');


// routes/web.php
Route::get('/icons-test', function () {
    return Inertia::render('Test/IconsPreview');
});

/*
|--------------------------------------------------------------------------
| Admin Panel Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Customers
    Route::resource('customers', CustomerController::class);
    Route::post('customers/export', [CustomerController::class, 'export'])->name('customers.export');
    
    // Leads
    Route::resource('leads', LeadController::class);
    Route::post('leads/{lead}/convert', [LeadController::class, 'convert'])->name('leads.convert');
    Route::post('leads/{lead}/assign', [LeadController::class, 'assign'])->name('leads.assign');
    Route::post('leads/export', [LeadController::class, 'export'])->name('leads.export');
    
    // Demo Requests
    Route::resource('demo-requests', DemoRequestController::class);
    Route::post('demo-requests/{demoRequest}/schedule', [DemoRequestController::class, 'schedule'])->name('demo-requests.schedule');
    Route::post('demo-requests/{demoRequest}/complete', [DemoRequestController::class, 'complete'])->name('demo-requests.complete');
    Route::post('demo-requests/{demoRequest}/cancel', [DemoRequestController::class, 'cancel'])->name('demo-requests.cancel');
    
});

/*
|--------------------------------------------------------------------------
| Customer Portal Routes
|--------------------------------------------------------------------------
*/

Route::prefix('portal')->name('portal.')->middleware(['auth:customer'])->group(function () {
    
    Route::get('/dashboard', [CustomerPortalController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [CustomerPortalController::class, 'profile'])->name('profile');
    Route::put('/profile', [CustomerPortalController::class, 'updateProfile'])->name('profile.update');
    Route::get('/subscription', [CustomerPortalController::class, 'subscription'])->name('subscription');
    Route::get('/invoices', [CustomerPortalController::class, 'invoices'])->name('invoices');
    Route::get('/support', [CustomerPortalController::class, 'support'])->name('support');
    
});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';