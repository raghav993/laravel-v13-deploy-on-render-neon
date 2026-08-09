<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Users
        |--------------------------------------------------------------------------
        */

        Schema::table('users', function (Blueprint $table) {
            $table->string('role', 20)
                ->default('customer')
                ->after('name');

            $table->string('phone', 20)
                ->nullable()
                ->unique()
                ->after('email');
        });

        /*
        |--------------------------------------------------------------------------
        | States
        |--------------------------------------------------------------------------
        */

        Schema::create('states', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('code', 10)->nullable();
            $table->string('country_code', 2)->default('IN');

            $table->timestamps();
            $table->softDeletes();

            $table->unique('code', 'states_code_unique');
            $table->unique(
                ['name', 'country_code'],
                'states_name_country_unique'
            );
        });

        /*
        |--------------------------------------------------------------------------
        | Cities
        |--------------------------------------------------------------------------
        */

        Schema::create('cities', function (Blueprint $table) {
            $table->id();

            $table->foreignId('state_id')
                ->constrained('states')
                ->restrictOnDelete();

            $table->string('name');
            $table->string('slug');

            $table->timestamps();
            $table->softDeletes();

            $table->unique('slug', 'cities_slug_unique');

            $table->unique(
                ['state_id', 'name'],
                'cities_state_name_unique'
            );

            $table->index(
                ['state_id', 'name'],
                'cities_state_name_idx'
            );
        });

        /*
        |--------------------------------------------------------------------------
        | Localities
        |--------------------------------------------------------------------------
        */

        Schema::create('localities', function (Blueprint $table) {
            $table->id();

            $table->foreignId('city_id')
                ->constrained('cities')
                ->restrictOnDelete();

            $table->string('name');
            $table->string('slug');

            $table->string('pincode', 10)->nullable();

            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->unique(
                ['city_id', 'slug'],
                'localities_city_slug_unique'
            );

            $table->index(
                ['city_id', 'name'],
                'localities_city_name_idx'
            );
        });

        /*
        |--------------------------------------------------------------------------
        | Service Categories
        |--------------------------------------------------------------------------
        */

        Schema::create('service_categories', function (Blueprint $table) {
            $table->id();

            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('service_categories')
                ->nullOnDelete();

            $table->string('name');
            $table->string('name_hi')->nullable();
            $table->string('slug');

            $table->text('description')->nullable();

            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();
            $table->softDeletes();

            $table->unique('slug', 'service_categories_slug_unique');

            $table->index(
                ['parent_id', 'is_active'],
                'service_categories_parent_active_idx'
            );
        });

        /*
        |--------------------------------------------------------------------------
        | Services
        |--------------------------------------------------------------------------
        */

        Schema::create('services', function (Blueprint $table) {
            $table->id();

            $table->foreignId('service_category_id')
                ->constrained('service_categories')
                ->restrictOnDelete();

            $table->string('name');
            $table->string('name_hi')->nullable();
            $table->string('slug');

            $table->text('description')->nullable();

            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();
            $table->softDeletes();

            $table->unique('slug', 'services_slug_unique');

            $table->index(
                ['service_category_id', 'is_active'],
                'services_category_active_idx'
            );
        });

        /*
        |--------------------------------------------------------------------------
        | Helper Profiles
        |--------------------------------------------------------------------------
        */

        Schema::create('helper_profiles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->unique()
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('locality_id')
                ->nullable()
                ->constrained('localities')
                ->restrictOnDelete();

            $table->string('gender', 30)->nullable();

            $table->date('date_of_birth')->nullable();

            $table->string('profile_photo')->nullable();

            $table->string('alternate_contact', 20)->nullable();

            $table->text('bio')->nullable();

            $table->unsignedTinyInteger('experience_years')
                ->default(0);

            $table->text('previous_work_experience')->nullable();

            $table->decimal('expected_salary', 10, 2)->nullable();

            $table->string('salary_type', 20)
                ->default('monthly');

            $table->string('work_type', 20)
                ->default('part_time');

            $table->string('availability_status', 20)
                ->default('available');

            $table->boolean('immediate_availability')
                ->default(true);

            $table->string('preferred_working_hours')
                ->nullable();

            $table->string('languages')
                ->nullable();

            $table->string('address_line')
                ->nullable();

            $table->string('pincode', 10)
                ->nullable();

            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            $table->string('profile_status', 20)
                ->default('active');

            $table->timestamps();
            $table->softDeletes();

            $table->index(
                ['locality_id', 'work_type', 'availability_status'],
                'helpers_locality_work_status_idx'
            );

            $table->index(
                ['expected_salary', 'experience_years'],
                'helpers_salary_experience_idx'
            );

            $table->index(
                ['profile_status', 'immediate_availability'],
                'helpers_status_immediate_idx'
            );
        });

        /*
        |--------------------------------------------------------------------------
        | Customer Profiles
        |--------------------------------------------------------------------------
        */

        Schema::create('customer_profiles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->unique()
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('locality_id')
                ->nullable()
                ->constrained('localities')
                ->restrictOnDelete();

            $table->string('address_line')->nullable();

            $table->string('pincode', 10)->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(
                'locality_id',
                'customers_locality_idx'
            );
        });

        /*
        |--------------------------------------------------------------------------
        | Helper Services Pivot
        |--------------------------------------------------------------------------
        */

        Schema::create('helper_service', function (Blueprint $table) {
            $table->id();

            $table->foreignId('helper_profile_id')
                ->constrained('helper_profiles')
                ->cascadeOnDelete();

            $table->foreignId('service_id')
                ->constrained('services')
                ->restrictOnDelete();

            $table->unsignedTinyInteger('experience_years')
                ->nullable();

            $table->decimal('service_rate', 10, 2)
                ->nullable();

            $table->string('rate_type', 20)
                ->nullable();

            $table->boolean('is_primary')
                ->default(false);

            $table->text('notes')->nullable();

            $table->timestamps();

            $table->unique(
                ['helper_profile_id', 'service_id'],
                'helper_service_unique'
            );

            $table->index(
                ['service_id', 'is_primary'],
                'helper_service_primary_idx'
            );
        });

        /*
        |--------------------------------------------------------------------------
        | Helper Availability
        |--------------------------------------------------------------------------
        */

        Schema::create('helper_availabilities', function (Blueprint $table) {
            $table->id();

            $table->foreignId('helper_profile_id')
                ->constrained('helper_profiles')
                ->cascadeOnDelete();

            // ISO-8601: 1 = Monday ... 7 = Sunday
            $table->unsignedTinyInteger('day_of_week');

            $table->time('start_time');
            $table->time('end_time');

            $table->string('preference', 20)
                ->nullable();

            $table->timestamps();

            // Explicit short name keeps MySQL index identifiers under 64 chars.
            $table->index(
                [
                    'helper_profile_id',
                    'day_of_week',
                    'start_time',
                    'end_time'
                ],
                'helper_availability_search_idx'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('helper_availabilities');
        Schema::dropIfExists('helper_service');
        Schema::dropIfExists('customer_profiles');
        Schema::dropIfExists('helper_profiles');
        Schema::dropIfExists('services');
        Schema::dropIfExists('service_categories');
        Schema::dropIfExists('localities');
        Schema::dropIfExists('cities');
        Schema::dropIfExists('states');

        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique('users_phone_unique');
            $table->dropColumn([
                'role',
                'phone',
            ]);
        });
    }
};