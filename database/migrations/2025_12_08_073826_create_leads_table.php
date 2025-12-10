<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            
            // Contact Information
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('company_name')->nullable();
            
            // Business Details
            $table->enum('business_type', [
                'cafe', 
                'restaurant', 
                'fast-food', 
                'fine-dining', 
                'chain', 
                'other'
            ])->nullable();
            
            // Lead Information
            $table->text('message')->nullable();
            $table->enum('source', [
                'website_contact', 
                'demo_request', 
                'referral', 
                'social_media', 
                'email_campaign',
                'phone_call',
                'other'
            ])->default('website_contact');
            
            // Lead Status & Priority
            $table->enum('status', [
                'new', 
                'contacted', 
                'qualified', 
                'demo_scheduled', 
                'proposal_sent', 
                'negotiation', 
                'won', 
                'lost'
            ])->default('new');
            
            $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('medium');
            $table->integer('lead_score')->default(0); // 0-100 scoring system
            
            // Assignment & Conversion
            $table->unsignedBigInteger('assigned_to')->nullable();
            $table->unsignedBigInteger('converted_to_customer_id')->nullable();
            $table->timestamp('converted_at')->nullable();
            
            // Follow-up
            $table->timestamp('last_contacted_at')->nullable();
            $table->timestamp('next_follow_up_at')->nullable();
            $table->text('notes')->nullable();
            
            // Tracking
            $table->string('utm_source')->nullable();
            $table->string('utm_medium')->nullable();
            $table->string('utm_campaign')->nullable();
            $table->string('referrer_url')->nullable();
            $table->ipAddress('ip_address')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index('email');
            $table->index('status');
            $table->index('priority');
            $table->index('assigned_to');
            $table->index('created_at');
            
            // Foreign Keys
            $table->foreign('converted_to_customer_id')
                  ->references('id')
                  ->on('customers')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};