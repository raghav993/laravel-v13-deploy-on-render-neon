<?php

namespace Database\Factories;

use App\Models\HelperProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

class HelperProfileFactory extends Factory
{
    protected $model = HelperProfile::class;

    public function definition(): array
    {
        return [
            'gender' => 'female',
            'experience_years' => fake()->numberBetween(1, 12),
            'expected_salary' => fake()->numberBetween(4000, 15000),
            'salary_type' => 'monthly',
            'work_type' => fake()->randomElement(['part_time', 'full_time']),
            'availability_status' => 'available',
            'immediate_availability' => true,
            'languages' => 'Hindi',
            'profile_status' => 'active',
        ];
    }
}
