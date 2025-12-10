<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            
            // Subscription Details
            $table->enum('plan_name', ['starter', 'professional', 'enterprise']);
            $table->decimal('price', 10, 2);
            $table->enum('billing_cycle', ['monthly', 'yearly'])->default('monthly');
            
            // Status
            $table->enum('status', [
                'active', 
                'trial', 
                'cancelled', 
                'expired', 
                'suspended'
            ])->default('trial');
            
            // Dates
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->date('trial_ends_at')->nullable();
            $table->date('next_billing_date')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            
            // Payment Details
            $table->string('payment_method')->nullable();
            $table->string('stripe_subscription_id')->nullable();
            $table->string('stripe_customer_id')->nullable();
            
            // Features
            $table->json('features')->nullable(); // Store included features
            $table->integer('max_terminals')->default(1);
            $table->integer('max_users')->default(5);
            $table->boolean('advanced_reporting')->default(false);
            $table->boolean('api_access')->default(false);
            $table->boolean('priority_support')->default(false);
            
            // Notes
            $table->text('notes')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index('customer_id');
            $table->index('status');
            $table->index('next_billing_date');
            
            // Foreign Keys
            $table->foreign('customer_id')
                  ->references('id')
                  ->on('customers')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};