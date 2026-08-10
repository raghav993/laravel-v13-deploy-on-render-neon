<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('local_workers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('name');
            $table->string('phone', 20);
            $table->string('category', 40)->index();
            $table->json('skills')->nullable();
            $table->text('bio')->nullable();
            $table->string('city', 100)->index();
            $table->string('area', 120)->nullable()->index();
            $table->unsignedTinyInteger('experience_years')->default(0);
            $table->enum('service_type', ['full_time', 'part_time', 'on_demand'])->default('on_demand');
            $table->enum('availability_status', ['available', 'busy', 'unavailable'])->default('available')->index();
            $table->decimal('hourly_rate', 10, 2)->nullable();
            $table->string('avatar_color', 20)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('local_workers');
    }
};
