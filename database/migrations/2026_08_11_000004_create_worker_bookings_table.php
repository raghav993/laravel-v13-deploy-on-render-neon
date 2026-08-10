<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('worker_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('local_worker_id')->constrained('local_workers')->cascadeOnDelete();
            $table->foreignId('customer_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('customer_name');
            $table->string('customer_phone', 20);
            $table->date('service_date');
            $table->string('service_time', 30);
            $table->text('address');
            $table->text('notes')->nullable();
            $table->enum('status', ['pending', 'accepted', 'rejected', 'completed', 'cancelled'])->default('pending')->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('worker_bookings');
    }
};
