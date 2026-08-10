<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('helper_profile_id')->constrained('helper_profiles')->cascadeOnDelete();
            $table->string('status', 20)->default('pending'); // pending, accepted, denied, blocked
            $table->foreignId('blocked_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('responded_at')->nullable();
            $table->timestamp('blocked_at')->nullable();
            $table->timestamps();

            $table->unique(['customer_id', 'helper_profile_id'], 'contact_requests_pair_unique');
            $table->index(['helper_profile_id', 'status'], 'contact_requests_helper_status_idx');
            $table->index(['customer_id', 'status'], 'contact_requests_customer_status_idx');
        });

        Schema::create('contact_chat_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_request_id')->constrained('contact_requests')->cascadeOnDelete();
            $table->foreignId('sender_id')->constrained('users')->cascadeOnDelete();
            $table->text('body');
            $table->timestamps();

            $table->index(['contact_request_id', 'created_at'], 'contact_messages_request_created_idx');
        });

        Schema::create('contact_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_request_id')->constrained('contact_requests')->cascadeOnDelete();
            $table->foreignId('reporter_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('reported_user_id')->constrained('users')->cascadeOnDelete();
            $table->string('reason', 80);
            $table->text('description')->nullable();
            $table->timestamps();

            $table->index(['reported_user_id', 'created_at'], 'contact_reports_reported_idx');
            $table->unique(['contact_request_id', 'reporter_id'], 'contact_reports_once_unique');
        });

        Schema::create('contact_calls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_request_id')->constrained('contact_requests')->cascadeOnDelete();
            $table->foreignId('initiated_by')->constrained('users')->cascadeOnDelete();
            $table->string('provider', 40);
            $table->string('provider_call_id')->nullable();
            $table->string('status', 30)->default('initiated');
            $table->timestamps();

            $table->index(['contact_request_id', 'created_at'], 'contact_calls_request_created_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_calls');
        Schema::dropIfExists('contact_reports');
        Schema::dropIfExists('contact_chat_messages');
        Schema::dropIfExists('contact_requests');
    }
};
