<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SahayikaServiceSeeder extends Seeder
{
    public function run(): void
    {
        $groups = [
            ['name' => 'Household Work', 'name_hi' => 'घर का काम', 'slug' => 'household-work', 'services' => [
                ['name'=>'Sweeping & Mopping','name_hi'=>'झाड़ू-पोंछा','slug'=>'sweeping-mopping'],
                ['name'=>'Dishwashing','name_hi'=>'बर्तन','slug'=>'dishwashing'],
                ['name'=>'Home Cleaning','name_hi'=>'घर की सफाई','slug'=>'home-cleaning'],
                ['name'=>'Laundry','name_hi'=>'कपड़े धोना','slug'=>'laundry'],
                ['name'=>'Ironing Clothes','name_hi'=>'कपड़े प्रेस करना','slug'=>'ironing-clothes'],
            ]],
            ['name' => 'Cooking', 'name_hi' => 'खाना', 'slug' => 'cooking', 'services' => [
                ['name'=>'Home Cook','name_hi'=>'खाना बनाने वाली','slug'=>'home-cook'],
                ['name'=>'Kitchen Helper','name_hi'=>'रसोई की मदद','slug'=>'kitchen-helper'],
                ['name'=>'Daily Meal Preparation','name_hi'=>'रोज़ का खाना','slug'=>'daily-meal-preparation'],
            ]],
            ['name' => 'Child Care', 'name_hi' => 'बच्चों की देखभाल', 'slug' => 'child-care', 'services' => [
                ['name'=>'Baby Care','name_hi'=>'Baby Care','slug'=>'baby-care'],
                ['name'=>'Aya / Nanny','name_hi'=>'आया / Nanny','slug'=>'aya-nanny'],
                ['name'=>'Child Massage','name_hi'=>'बच्चों की मालिश','slug'=>'child-massage'],
                ['name'=>'Child Supervision','name_hi'=>'बच्चों को संभालना','slug'=>'child-supervision'],
            ]],
            ['name' => 'Elder Care', 'name_hi' => 'बुजुर्गों की देखभाल', 'slug' => 'elder-care', 'services' => [
                ['name'=>'Elder Care','name_hi'=>'Elder Care','slug'=>'elder-care'],
                ['name'=>'Daily Living Assistance','name_hi'=>'रोज़मर्रा की सहायता','slug'=>'daily-living-assistance'],
            ]],
            ['name' => 'Other Domestic Help', 'name_hi' => 'अन्य घरेलू मदद', 'slug' => 'other-domestic-help', 'services' => [
                ['name'=>'Full-time Domestic Helper','name_hi'=>'Full-time घरेलू सहायिका','slug'=>'full-time-domestic-helper'],
                ['name'=>'Part-time Domestic Helper','name_hi'=>'Part-time घरेलू सहायिका','slug'=>'part-time-domestic-helper'],
                ['name'=>'All-rounder','name_hi'=>'हरफनमौला / All-rounder','slug'=>'all-rounder'],
            ]],
        ];

        foreach ($groups as $categoryIndex => $group) {
            $category = ServiceCategory::updateOrCreate(
                ['slug' => $group['slug']],
                [
                    'name' => $group['name'],
                    'name_hi' => $group['name_hi'],
                    'sort_order' => $categoryIndex + 1,
                    'is_active' => true,
                ]
            );

            foreach ($group['services'] as $serviceIndex => $item) {
                Service::updateOrCreate(
                    ['slug' => $item['slug']],
                    [
                        'service_category_id' => $category->id,
                        'name' => $item['name'],
                        'name_hi' => $item['name_hi'],
                        'sort_order' => $serviceIndex + 1,
                        'is_active' => true,
                    ]
                );
            }
        }
    }
}
