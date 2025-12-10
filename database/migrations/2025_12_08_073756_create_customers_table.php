<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
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
            $table->text('business_description')->nullable();
            
            // Address Information
            $table->string('address_line_1')->nullable();
            $table->string('address_line_2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('country')->default('UK');
            
            // Subscription Details
            $table->enum('subscription_plan', ['starter', 'professional', 'enterprise'])->nullable();
            $table->enum('subscription_status', [
                'active', 
                'trial', 
                'cancelled', 
                'expired', 
                'pending'
            ])->default('pending');
            $table->date('subscription_start_date')->nullable();
            $table->date('subscription_end_date')->nullable();
            $table->decimal('monthly_fee', 10, 2)->nullable();
            
            // Additional Information
            $table->integer('number_of_locations')->default(1);
            $table->integer('number_of_terminals')->default(1);
            $table->text('notes')->nullable();
            
            // Status and Tracking
            $table->enum('status', ['lead', 'trial', 'active', 'churned', 'inactive'])->default('lead');
            $table->string('source')->nullable(); // website, referral, sales, etc.
            $table->unsignedBigInteger('assigned_sales_rep')->nullable();
            
            // Timestamps
            $table->timestamp('last_login_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index('email');
            $table->index('subscription_status');
            $table->index('status');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};