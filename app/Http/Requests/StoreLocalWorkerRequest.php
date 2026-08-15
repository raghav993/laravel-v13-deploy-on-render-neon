<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLocalWorkerRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'], 'phone' => ['required', 'string', 'max:20'],
            'category' => ['required', Rule::in(array_keys(\App\Http\Controllers\LocalWorkerController::CATEGORIES))],
            'skills' => ['nullable', 'string', 'max:500'], 'bio' => ['nullable', 'string', 'max:1000'],
            'city' => ['required', 'string', 'max:100'], 'area' => ['nullable', 'string', 'max:120'],
            'experience_years' => ['required', 'integer', 'min:0', 'max:60'],
            'service_type' => ['required', Rule::in(['full_time', 'part_time', 'on_demand'])],
            'hourly_rate' => ['nullable', 'numeric', 'min:0', 'max:999999'],
            'expected_salary' => ['nullable', 'numeric', 'min:0', 'max:9999999'],
            'gender' => ['nullable', Rule::in(['female', 'male', 'other', 'prefer_not_to_say'])],
            'languages' => ['nullable', 'string', 'max:255'], 'certifications' => ['nullable', 'string', 'max:500'],
            'working_hours' => ['nullable', 'string', 'max:100'],
        ];
    }
}
