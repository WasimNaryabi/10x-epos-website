<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('demo_requests', function (Blueprint $table) {
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
            ]);
            
            // Demo Scheduling
            $table->date('preferred_date')->nullable();
            $table->time('preferred_time')->nullable();
            $table->enum('demo_type', ['online', 'in-person', 'phone'])->default('online');
            
            // Status
            $table->enum('status', [
                'pending', 
                'scheduled', 
                'completed', 
                'cancelled', 
                'no-show'
            ])->default('pending');
            
            // Demo Details
            $table->dateTime('scheduled_at')->nullable();
            $table->dateTime('completed_at')->nullable();
            $table->string('meeting_link')->nullable(); // Zoom/Teams link
            $table->text('notes')->nullable();
            $table->text('admin_notes')->nullable();
            
            // Assignment
            $table->unsignedBigInteger('assigned_to')->nullable();
            $table->unsignedBigInteger('lead_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            
            // Follow-up
            $table->boolean('follow_up_sent')->default(false);
            $table->timestamp('follow_up_sent_at')->nullable();
            
            // Tracking
            $table->string('utm_source')->nullable();
            $table->string('utm_campaign')->nullable();
            $table->ipAddress('ip_address')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index('email');
            $table->index('status');
            $table->index('scheduled_at');
            $table->index('created_at');
            
            // Foreign Keys
            $table->foreign('lead_id')
                  ->references('id')
                  ->on('leads')
                  ->onDelete('set null');
                  
            $table->foreign('customer_id')
                  ->references('id')
                  ->on('customers')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('demo_requests');
    }
};