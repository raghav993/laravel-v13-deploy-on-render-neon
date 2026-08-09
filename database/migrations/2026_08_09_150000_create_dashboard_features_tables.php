<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('helper_profile_id')->constrained('helper_profiles')->cascadeOnDelete();
            $table->foreignId('service_id')->nullable()->constrained('services')->nullOnDelete();
            $table->date('booking_date')->nullable();
            $table->time('start_time')->nullable();
            $table->unsignedSmallInteger('duration_hours')->nullable();
            $table->decimal('agreed_amount',10,2)->nullable();
            $table->string('status',30)->default('pending'); // pending, accepted, rejected, confirmed, completed, cancelled
            $table->text('customer_note')->nullable();
            $table->text('helper_note')->nullable();
            $table->text('admin_note')->nullable();
            $table->timestamps();
            $table->index(['customer_id','status']);
            $table->index(['helper_profile_id','status']);
        });

        Schema::create('helper_remarks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('helper_profile_id')->constrained('helper_profiles')->cascadeOnDelete();
            $table->foreignId('booking_id')->nullable()->constrained('bookings')->nullOnDelete();
            $table->unsignedTinyInteger('rating')->nullable();
            $table->text('remark');
            $table->boolean('is_private')->default(false);
            $table->timestamps();
        });

        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('helper_profile_id')->constrained('helper_profiles')->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['customer_id','helper_profile_id']);
        });

        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('name');
            $table->string('role_label')->nullable();
            $table->text('message');
            $table->unsignedTinyInteger('rating')->default(5);
            $table->string('photo')->nullable();
            $table->boolean('is_approved')->default(false);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('type',30)->default('text'); // text, image, boolean
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('site_settings');
        Schema::dropIfExists('testimonials');
        Schema::dropIfExists('favorites');
        Schema::dropIfExists('helper_remarks');
        Schema::dropIfExists('bookings');
    }
};
