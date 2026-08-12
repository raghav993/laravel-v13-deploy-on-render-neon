<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        /*
         * Sahayika uses contextual validation messages instead of exposing
         * raw Laravel rule/field names to end users.
         */
        $messages = [
            'required' => [
                'name' => 'कृपया अपना नाम दर्ज करें।',
                'phone' => 'कृपया अपना मोबाइल नंबर दर्ज करें।',
                'email' => 'कृपया अपना ईमेल पता दर्ज करें।',
                'password' => 'कृपया पासवर्ड दर्ज करें।',
                'password_confirmation' => 'कृपया पासवर्ड की पुष्टि करें।',
                'identifier' => 'कृपया अपना मोबाइल नंबर या ईमेल दर्ज करें।',
                'service_id' => 'कृपया सेवा का चयन करें।',
                'service_ids' => 'कृपया कम से कम एक सेवा चुनें।',
                'booking_date' => 'कृपया booking की तारीख चुनें।',
                'status' => 'कृपया एक मान्य status चुनें।',
                'body' => 'कृपया message लिखें।',
                'reason' => 'कृपया report का कारण चुनें।',
                'description' => 'कृपया विवरण दर्ज करें।',
                'rating' => 'कृपया 1 से 5 stars के बीच rating चुनें।',
                'remark' => 'कृपया अपना remark लिखें।',
                'photo' => 'कृपया profile photo चुनें।',
            ],
            'email' => [
                'email' => 'कृपया सही email address दर्ज करें।',
            ],
            'confirmed' => [
                'password' => 'Password और confirmation password समान नहीं हैं।',
            ],
            'integer' => [
                'experience_years' => 'Experience केवल पूरे वर्षों में दर्ज करें।',
                'duration_hours' => 'काम की अवधि घंटों में एक मान्य संख्या होनी चाहिए।',
                'rating' => 'Rating 1 से 5 के बीच होनी चाहिए।',
            ],
            'exists' => [
                'service_id' => 'चयनित सेवा उपलब्ध नहीं है। कृपया कोई दूसरी सेवा चुनें।',
                'locality_id' => 'चयनित locality उपलब्ध नहीं है।',
                'booking_id' => 'यह booking उपलब्ध नहीं है।',
                'service_category_id' => 'चयनित service category उपलब्ध नहीं है।',
            ],
            'unique' => [
                'phone' => 'इस मोबाइल नंबर से पहले ही account बना हुआ है।',
                'email' => 'इस email address से पहले ही account बना हुआ है।',
                'slug' => 'यह service URL पहले से उपयोग में है। कृपया दूसरा नाम चुनें।',
            ],
            'in' => [
                'role' => 'कृपया Customer या Helper में से सही account type चुनें।',
                'status' => 'यह status इस action के लिए मान्य नहीं है।',
                'availability_status' => 'कृपया उपलब्धता का सही status चुनें।',
                'reason' => 'कृपया उपलब्ध report reason में से एक चुनें।',
            ],
            'image' => [
                'photo' => 'कृपया valid image file upload करें।',
                'logo' => 'कृपया valid logo image upload करें।',
                'banner' => 'कृपया valid banner image upload करें।',
            ],
            'max' => [
                'body' => 'Message बहुत लंबा है। कृपया इसे 2000 characters के अंदर रखें।',
                'description' => 'Description बहुत लंबा है। कृपया इसे 2000 characters के अंदर रखें।',
                'bio' => 'About section बहुत लंबा है। कृपया इसे 2000 characters के अंदर रखें।',
            ],
        ];

        foreach ($messages as $rule => $fieldMessages) {
            Validator::replacer($rule, function ($message, $attribute) use ($fieldMessages) {
                return $fieldMessages[$attribute] ?? $message;
            });
        }

        Validator::replacer('min', function ($message, $attribute, $rule, $parameters) {
            if ($rule === 'min' && $attribute === 'password') {
                return 'Password कम से कम ' . ($parameters[0] ?? 8) . ' characters का होना चाहिए।';
            }
            if ($attribute === 'service_ids') {
                return 'कृपया कम से कम ' . ($parameters[0] ?? 1) . ' service चुनें।';
            }
            return $message;
        });

        Validator::replacer('required_if', function ($message, $attribute) {
            $labels = [
                'gender' => 'Helper account के लिए gender चुनना जरूरी है।',
                'service_ids' => 'Helper account के लिए कम से कम एक service चुनना जरूरी है।',
            ];
            return $labels[$attribute] ?? $message;
        });
        view()->composer('layouts_site', function ($view) {
            $view->with('siteSettings', SiteSetting::all()->keyBy('key'));
        });

        if (app()->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
