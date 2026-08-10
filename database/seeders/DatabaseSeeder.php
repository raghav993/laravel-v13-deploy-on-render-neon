<?php

namespace Database\Seeders;

use App\Models\LocalWorker;
use App\Models\User;
use Database\Seeders\DashboardDemoSeeder;
use Database\Seeders\IndoreDemoSeeder;
use Database\Seeders\SahayikaServiceSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'demo@sahayika.local'],
            ['name' => 'Demo Customer', 'password' => 'password']
        );
        $workers = [
            ['name' => 'Rakesh Kumar', 'phone' => '9000000001', 'category' => 'electrician', 'skills' => ['Wiring', 'Fan repair', 'Switch board'], 'city' => 'Indore', 'area' => 'Vijay Nagar', 'experience_years' => 6, 'service_type' => 'on_demand', 'hourly_rate' => 300, 'avatar_color' => '#155eef'],
            ['name' => 'Mahesh Verma', 'phone' => '9000000002', 'category' => 'carpenter', 'skills' => ['Furniture repair', 'Door fitting', 'Wood work'], 'city' => 'Indore', 'area' => 'Rau', 'experience_years' => 8, 'service_type' => 'on_demand', 'hourly_rate' => 450, 'avatar_color' => '#c05621'],
            ['name' => 'Suresh Prajapati', 'phone' => '9000000003', 'category' => 'mason', 'skills' => ['Tile work', 'Wall repair', 'Construction'], 'city' => 'Indore', 'area' => 'Bhawarkuan', 'experience_years' => 10, 'service_type' => 'on_demand', 'hourly_rate' => 500, 'avatar_color' => '#7c3aed'],
            ['name' => 'Neha Sharma', 'phone' => '9000000004', 'category' => 'iron', 'skills' => ['Steam press', 'Laundry pickup', 'Clothes care'], 'city' => 'Bhopal', 'area' => 'MP Nagar', 'experience_years' => 5, 'service_type' => 'part_time', 'hourly_rate' => 250, 'avatar_color' => '#087f5b'],
            ['name' => 'Amit Khan', 'phone' => '9000000005', 'category' => 'barber', 'skills' => ['Haircut', 'Beard trim', 'Home visit'], 'city' => 'Indore', 'area' => 'Palasia', 'experience_years' => 7, 'service_type' => 'on_demand', 'hourly_rate' => 350, 'avatar_color' => '#be123c'],
            ['name' => 'Pooja Jain', 'phone' => '9000000006', 'category' => 'massage', 'skills' => ['Head massage', 'Relaxation massage', 'Home visit'], 'city' => 'Bhopal', 'area' => 'Arera Colony', 'experience_years' => 4, 'service_type' => 'on_demand', 'hourly_rate' => 400, 'avatar_color' => '#0f766e'],
        ];

        foreach ($workers as $worker) {
            LocalWorker::updateOrCreate(['phone' => $worker['phone']], array_merge($worker, [
                'user_id' => $user->id,
                'availability_status' => 'available',
                'bio' => 'Local professional profile. Booking से पहले service details और charges confirm करें।',
            ]));
        }
        $this->call([
            SahayikaServiceSeeder::class,
            IndoreDemoSeeder::class,
            DashboardDemoSeeder::class,
        ]);
    }
}
