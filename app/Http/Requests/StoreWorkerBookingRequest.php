<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWorkerBookingRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array { return [
        'customer_name' => ['required', 'string', 'max:100'], 'customer_phone' => ['required', 'string', 'max:20'],
        'service_date' => ['required', 'date', 'after_or_equal:today'], 'service_time' => ['required', 'string', 'max:30'],
        'address' => ['required', 'string', 'max:1000'], 'notes' => ['nullable', 'string', 'max:1000'],
    ]; }
}
