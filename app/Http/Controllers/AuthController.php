<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Locality;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function showRegister()
    {
        $city = City::where('slug', 'indore')->first();
        $localities = $city?->localities()->orderBy('name')->get() ?? collect();
        $services = Service::where('is_active', true)->orderBy('service_category_id')->orderBy('sort_order')->get();

        return view('register', compact('localities', 'services'));
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'role' => ['required', Rule::in(['customer', 'helper'])],
            'name' => ['required','string','max:120'],
            'phone' => ['required','string','max:20','unique:users,phone'],
            'email' => ['required','email','max:255','unique:users,email'],
            'password' => ['required','string','min:8','confirmed'],
            'locality_id' => ['nullable','integer','exists:localities,id'],
            'address_line' => ['nullable','string','max:255'],
            'pincode' => ['nullable','string','max:10'],
            'gender' => ['required_if:role,helper', Rule::in(['female','male','other','prefer_not_to_say'])],
            'date_of_birth' => ['nullable','date','before:today'],
            'experience_years' => ['nullable','integer','min:0','max:60'],
            'expected_salary' => ['nullable','numeric','min:0','max:99999999.99'],
            'salary_type' => ['nullable', Rule::in(['monthly','daily','hourly'])],
            'work_type' => ['nullable', Rule::in(['full_time','part_time'])],
            'languages' => ['nullable','string','max:255'],
            'bio' => ['nullable','string','max:2000'],
            'service_ids' => ['required_if:role,helper','array','min:1'],
            'service_ids.*' => ['integer','exists:services,id'],
            'immediate_availability' => ['nullable','boolean'],
        ]);

        $user = DB::transaction(function () use ($validated) {
            $user = User::create([
                'name' => $validated['name'],
                'phone' => $validated['phone'],
                'email' => $validated['email'] ?? null,
                'password' => $validated['password'],
                'role' => $validated['role'],
            ]);

            if ($user->isHelper()) {
                $profile = $user->helperProfile()->create([
                    'locality_id' => $validated['locality_id'] ?? null,
                    'gender' => $validated['gender'] ?? null,
                    'date_of_birth' => $validated['date_of_birth'] ?? null,
                    'experience_years' => $validated['experience_years'] ?? 0,
                    'expected_salary' => $validated['expected_salary'] ?? null,
                    'salary_type' => $validated['salary_type'] ?? 'monthly',
                    'work_type' => $validated['work_type'] ?? 'part_time',
                    'languages' => $validated['languages'] ?? null,
                    'bio' => $validated['bio'] ?? null,
                    'address_line' => $validated['address_line'] ?? null,
                    'pincode' => $validated['pincode'] ?? null,
                    'immediate_availability' => (bool) ($validated['immediate_availability'] ?? true),
                    'profile_status' => 'active',
                ]);
                $profile->services()->sync(array_fill_keys($validated['service_ids'], ['is_primary' => false]));
                $profile->services()->first()?->pivot?->update(['is_primary' => true]);
            } else {
                $user->customerProfile()->create([
                    'locality_id' => $validated['locality_id'] ?? null,
                    'address_line' => $validated['address_line'] ?? null,
                    'pincode' => $validated['pincode'] ?? null,
                ]);
            }

            return $user;
        });

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('dashboard')->with('success', 'Account created successfully.');
    }

    public function showLogin()
    {
        // dd(Auth::user()->name);
        return view('login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'identifier' => ['required','string','max:255'],
            'password' => ['required','string'],
            'role' => ['required', Rule::in(['customer','helper','admin'])],
            'remember' => ['nullable','boolean'],
        ]);

        $field = filter_var($validated['identifier'], FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        $credentials = [
            $field => $validated['identifier'],
            'password' => $validated['password'],
            'role' => $validated['role'],
        ];

        if (!Auth::attempt($credentials, (bool) ($validated['remember'] ?? false))) {
            return back()->withErrors(['identifier' => 'The login details do not match this account type.'])->withInput($request->only('identifier','role'));
        }

        $request->session()->regenerate();
        return redirect()->route('dashboard')->with('success', 'Welcome back to Sahayika.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'You have been logged out.');
    }
}
