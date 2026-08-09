<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\CustomerProfile;
use App\Models\HelperAvailability;
use App\Models\HelperProfile;
use App\Models\Locality;
use App\Models\Service;
use App\Models\State;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class IndoreDemoSeeder extends Seeder
{
    public function run(): void
    {
        $state = State::updateOrCreate(['code' => 'MP'], [
            'name' => 'Madhya Pradesh',
            'country_code' => 'IN',
        ]);

        $city = City::updateOrCreate(['slug' => 'indore'], [
            'state_id' => $state->id,
            'name' => 'Indore',
        ]);

        $localityNames = [
            'Vijay Nagar','Scheme No. 54','Scheme No. 78','Bengali Square','Saket Nagar',
            'Palasia','Bhanwar Kuan','Rau','Nipania','Mahalaxmi Nagar','Sudama Nagar',
            'Annapurna Road','Rajendra Nagar','Tilak Nagar','Geeta Bhawan','LIG Colony',
            'MIG Colony','Khajrana','Aerodrome Road','Silicon City','Super Corridor',
            'Kanadia Road','MR-10 Area',
        ];

        $localities = [];
        foreach ($localityNames as $i => $name) {
            $slug = Str::slug($name);
            $localities[$name] = Locality::updateOrCreate(
                ['city_id' => $city->id, 'slug' => $slug],
                [
                    'name' => $name,
                    'pincode' => '4520' . str_pad((string) (($i % 9) + 1), 2, '0', STR_PAD_LEFT),
                ]
            );
        }

        $services = Service::where('is_active', true)->get()->keyBy('slug');

        $password = Hash::make('Demo@12345');

        User::updateOrCreate(['email' => 'admin@sahayika.test'], [
            'name' => 'Sahayika Demo Admin',
            'phone' => '0000000001',
            'password' => $password,
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        $customerNames = [
            'Amit Sharma','Neha Verma','Rohit Jain','Pooja Mehta','Ankit Gupta','Kavita Joshi',
            'Saurabh Patel','Ritu Agrawal','Manish Tiwari','Shreya Singh','Nitin Bansal','Priya Malhotra',
        ];

        foreach ($customerNames as $i => $name) {
            $user = User::updateOrCreate(['email' => sprintf('demo.customer%02d@sahayika.test', $i + 1)], [
                'name' => $name,
                'phone' => sprintf('000000%04d', $i + 2),
                'password' => $password,
                'role' => 'customer',
                'email_verified_at' => now(),
            ]);
            CustomerProfile::updateOrCreate(['user_id' => $user->id], [
                'locality_id' => array_values($localities)[$i % count($localities)]->id,
                'address_line' => 'Demo household, development block ' . ($i + 1),
                'pincode' => array_values($localities)[$i % count($localities)]->pincode,
            ]);
        }

        $profiles = [
            ['name'=>'Sunita Verma','gender'=>'female','loc'=>'Vijay Nagar','exp'=>5,'salary'=>6200,'work'=>'part_time','services'=>['sweeping-mopping','dishwashing','home-cleaning'],'days'=>[1,2,3,4,5],'time'=>['08:00','12:00']],
            ['name'=>'Meena Yadav','gender'=>'female','loc'=>'Nipania','exp'=>7,'salary'=>8500,'work'=>'part_time','services'=>['home-cook','kitchen-helper','daily-meal-preparation'],'days'=>[1,2,3,4,5,6],'time'=>['07:00','11:00']],
            ['name'=>'Farida Khan','gender'=>'female','loc'=>'Palasia','exp'=>4,'salary'=>9000,'work'=>'part_time','services'=>['baby-care','child-massage','child-supervision'],'days'=>[1,2,3,4,5],'time'=>['09:00','14:00']],
            ['name'=>'Kamalabai Rathore','gender'=>'female','loc'=>'Rau','exp'=>8,'salary'=>12500,'work'=>'full_time','services'=>['all-rounder','full-time-domestic-helper','home-cleaning','home-cook'],'days'=>[1,2,3,4,5,6],'time'=>['08:00','18:00']],
            ['name'=>'Rekha Pawar','gender'=>'female','loc'=>'Scheme No. 54','exp'=>3,'salary'=>4800,'work'=>'part_time','services'=>['sweeping-mopping','dishwashing'],'days'=>[1,2,3,4,5],'time'=>['07:30','11:00']],
            ['name'=>'Asha Solanki','gender'=>'female','loc'=>'Scheme No. 78','exp'=>6,'salary'=>7200,'work'=>'part_time','services'=>['home-cleaning','laundry','ironing-clothes'],'days'=>[1,2,3,5,6],'time'=>['10:00','14:00']],
            ['name'=>'Laxmi Chouhan','gender'=>'female','loc'=>'Bengali Square','exp'=>2,'salary'=>4200,'work'=>'part_time','services'=>['sweeping-mopping','dishwashing','part-time-domestic-helper'],'days'=>[1,2,3,4,5],'time'=>['06:30','10:00']],
            ['name'=>'Sangeeta Pawar','gender'=>'female','loc'=>'Saket Nagar','exp'=>9,'salary'=>13500,'work'=>'full_time','services'=>['all-rounder','full-time-domestic-helper','home-cook'],'days'=>[1,2,3,4,5,6],'time'=>['08:00','19:00']],
            ['name'=>'Nirmala Bai','gender'=>'female','loc'=>'Mahalaxmi Nagar','exp'=>5,'salary'=>6800,'work'=>'part_time','services'=>['dishwashing','home-cleaning','laundry'],'days'=>[1,2,3,4,5,6],'time'=>['09:00','13:00']],
            ['name'=>'Poonam Sharma','gender'=>'female','loc'=>'Sudama Nagar','exp'=>4,'salary'=>7800,'work'=>'part_time','services'=>['home-cook','kitchen-helper'],'days'=>[1,2,3,4,5],'time'=>['18:00','21:00']],
            ['name'=>'Shabnam Sheikh','gender'=>'female','loc'=>'Annapurna Road','exp'=>6,'salary'=>9800,'work'=>'part_time','services'=>['baby-care','aya-nanny','child-supervision'],'days'=>[1,2,3,4,5,6],'time'=>['08:00','15:00']],
            ['name'=>'Maya Gurjar','gender'=>'female','loc'=>'Rajendra Nagar','exp'=>7,'salary'=>11000,'work'=>'full_time','services'=>['elder-care','daily-living-assistance','full-time-domestic-helper'],'days'=>[1,2,3,4,5,6],'time'=>['09:00','18:00']],
            ['name'=>'Rani Thakur','gender'=>'female','loc'=>'Tilak Nagar','exp'=>3,'salary'=>3500,'work'=>'part_time','services'=>['sweeping-mopping','dishwashing'],'days'=>[1,2,3,4,5],'time'=>['06:00','09:30']],
            ['name'=>'Kusum Jain','gender'=>'female','loc'=>'Geeta Bhawan','exp'=>10,'salary'=>14500,'work'=>'full_time','services'=>['all-rounder','home-cook','laundry'],'days'=>[1,2,3,4,5,6],'time'=>['07:30','18:30']],
            ['name'=>'Seema Sharma','gender'=>'female','loc'=>'Bhanwar Kuan','exp'=>5,'salary'=>6000,'work'=>'part_time','services'=>['home-cleaning','sweeping-mopping','ironing-clothes'],'days'=>[1,2,3,4,5],'time'=>['08:30','12:30']],
            ['name'=>'Kamla Verma','gender'=>'female','loc'=>'LIG Colony','exp'=>8,'salary'=>8800,'work'=>'part_time','services'=>['elder-care','daily-living-assistance'],'days'=>[1,2,3,4,5,6],'time'=>['10:00','15:00']],
            ['name'=>'Jyoti Rathore','gender'=>'female','loc'=>'MIG Colony','exp'=>4,'salary'=>6500,'work'=>'part_time','services'=>['home-cook','daily-meal-preparation'],'days'=>[1,2,3,4,5,6],'time'=>['07:00','10:30']],
            ['name'=>'Anita Yadav','gender'=>'female','loc'=>'Khajrana','exp'=>11,'salary'=>15000,'work'=>'full_time','services'=>['all-rounder','full-time-domestic-helper','elder-care'],'days'=>[1,2,3,4,5,6],'time'=>['08:00','19:00']],
            ['name'=>'Roshni Patel','gender'=>'female','loc'=>'Aerodrome Road','exp'=>2,'salary'=>5200,'work'=>'part_time','services'=>['baby-care','child-supervision'],'days'=>[1,2,3,4,5],'time'=>['08:00','13:00']],
            ['name'=>'Kiran Joshi','gender'=>'female','loc'=>'Silicon City','exp'=>6,'salary'=>7600,'work'=>'part_time','services'=>['sweeping-mopping','dishwashing','home-cleaning'],'days'=>[1,2,3,4,5,6],'time'=>['07:00','12:00']],
            ['name'=>'Mamata Sen','gender'=>'female','loc'=>'Super Corridor','exp'=>5,'salary'=>7000,'work'=>'part_time','services'=>['home-cook','kitchen-helper','daily-meal-preparation'],'days'=>[1,2,3,4,5],'time'=>['17:00','21:00']],
            ['name'=>'Pushpa Bai','gender'=>'female','loc'=>'Kanadia Road','exp'=>9,'salary'=>11800,'work'=>'full_time','services'=>['all-rounder','full-time-domestic-helper','home-cleaning'],'days'=>[1,2,3,4,5,6],'time'=>['08:00','18:00']],
            ['name'=>'Nisha Sharma','gender'=>'female','loc'=>'MR-10 Area','exp'=>3,'salary'=>4300,'work'=>'part_time','services'=>['sweeping-mopping','dishwashing'],'days'=>[1,2,3,4,5],'time'=>['07:00','10:30']],
            ['name'=>'Sarla Bai','gender'=>'female','loc'=>'Vijay Nagar','exp'=>12,'salary'=>16000,'work'=>'full_time','services'=>['all-rounder','home-cook','elder-care','full-time-domestic-helper'],'days'=>[1,2,3,4,5,6],'time'=>['07:30','19:00']],
            ['name'=>'Nandini Mishra','gender'=>'female','loc'=>'Nipania','exp'=>5,'salary'=>9200,'work'=>'part_time','services'=>['baby-care','aya-nanny','child-massage'],'days'=>[1,2,3,4,5],'time'=>['09:00','14:00']],
            ['name'=>'Vandana Gupta','gender'=>'female','loc'=>'Palasia','exp'=>7,'salary'=>8200,'work'=>'part_time','services'=>['home-cook','kitchen-helper'],'days'=>[1,2,3,4,5,6],'time'=>['07:00','11:00']],
            ['name'=>'Usha Bai','gender'=>'female','loc'=>'Rau','exp'=>6,'salary'=>10200,'work'=>'part_time','services'=>['elder-care','daily-living-assistance','child-supervision'],'days'=>[1,2,3,4,5],'time'=>['09:00','15:00']],
            ['name'=>'Rakhi Sahu','gender'=>'female','loc'=>'Bengali Square','exp'=>4,'salary'=>5800,'work'=>'part_time','services'=>['home-cleaning','laundry','ironing-clothes'],'days'=>[1,2,3,4,5,6],'time'=>['10:00','14:00']],
            ['name'=>'Sunanda Pawar','gender'=>'female','loc'=>'Saket Nagar','exp'=>8,'salary'=>12800,'work'=>'full_time','services'=>['all-rounder','full-time-domestic-helper','home-cook'],'days'=>[1,2,3,4,5,6],'time'=>['08:00','18:00']],
            ['name'=>'Chandni Khan','gender'=>'female','loc'=>'Scheme No. 54','exp'=>3,'salary'=>7200,'work'=>'part_time','services'=>['baby-care','child-supervision'],'days'=>[1,2,3,4,5],'time'=>['10:00','15:00']],
            ['name'=>'Rajni Verma','gender'=>'female','loc'=>'Scheme No. 78','exp'=>6,'salary'=>6900,'work'=>'part_time','services'=>['sweeping-mopping','dishwashing','home-cleaning'],'days'=>[1,2,3,4,5,6],'time'=>['07:30','12:00']],
            ['name'=>'Heena Ansari','gender'=>'female','loc'=>'Mahalaxmi Nagar','exp'=>9,'salary'=>11200,'work'=>'full_time','services'=>['elder-care','daily-living-assistance','full-time-domestic-helper'],'days'=>[1,2,3,4,5,6],'time'=>['09:00','18:00']],
            ['name'=>'Rupa Singh','gender'=>'female','loc'=>'Annapurna Road','exp'=>5,'salary'=>5600,'work'=>'part_time','services'=>['home-cleaning','laundry','ironing-clothes'],'days'=>[1,2,3,4,5],'time'=>['09:00','13:00']],
            ['name'=>'Shalini Tiwari','gender'=>'female','loc'=>'Rajendra Nagar','exp'=>4,'salary'=>7600,'work'=>'part_time','services'=>['home-cook','daily-meal-preparation'],'days'=>[1,2,3,4,5,6],'time'=>['17:30','21:00']],
            ['name'=>'Kanchan Solanki','gender'=>'female','loc'=>'Tilak Nagar','exp'=>7,'salary'=>9800,'work'=>'part_time','services'=>['baby-care','aya-nanny','child-massage'],'days'=>[1,2,3,4,5],'time'=>['08:00','14:00']],
            ['name'=>'Lalita Joshi','gender'=>'female','loc'=>'LIG Colony','exp'=>10,'salary'=>13500,'work'=>'full_time','services'=>['all-rounder','full-time-domestic-helper','home-cook','laundry'],'days'=>[1,2,3,4,5,6],'time'=>['08:00','19:00']],
            ['name'=>'Madhuri Patidar','gender'=>'female','loc'=>'Khajrana','exp'=>2,'salary'=>3900,'work'=>'part_time','services'=>['sweeping-mopping','dishwashing'],'days'=>[1,2,3,4,5],'time'=>['06:30','10:00']],
            ['name'=>'Savitri Bai','gender'=>'female','loc'=>'Silicon City','exp'=>8,'salary'=>10800,'work'=>'part_time','services'=>['elder-care','daily-living-assistance'],'days'=>[1,2,3,4,5,6],'time'=>['09:00','15:00']],
            ['name'=>'Kajal Meena','gender'=>'female','loc'=>'Super Corridor','exp'=>5,'salary'=>7400,'work'=>'part_time','services'=>['home-cook','kitchen-helper','daily-meal-preparation'],'days'=>[1,2,3,4,5],'time'=>['07:00','11:00']],
            ['name'=>'Bhavna Chouhan','gender'=>'female','loc'=>'Kanadia Road','exp'=>6,'salary'=>8600,'work'=>'part_time','services'=>['sweeping-mopping','dishwashing','home-cleaning'],'days'=>[1,2,3,4,5,6],'time'=>['08:00','12:00']],
        ];

        foreach ($profiles as $i => $data) {
            $user = User::updateOrCreate(['email' => sprintf('demo.helper%02d@sahayika.test', $i + 1)], [
                'name' => $data['name'],
                'phone' => sprintf('000001%04d', $i + 1),
                'password' => $password,
                'role' => 'helper',
                'email_verified_at' => now(),
            ]);

            $locality = $localities[$data['loc']];
            $profile = HelperProfile::updateOrCreate(['user_id' => $user->id], [
                'locality_id' => $locality->id,
                'gender' => $data['gender'],
                'experience_years' => $data['exp'],
                'bio' => 'Fictional development profile for testing Sahayika search and helper discovery.',
                'previous_work_experience' => $data['exp'] > 5 ? 'Prior household and family-support work in Indore (demo data).' : 'Prior household support experience (demo data).',
                'expected_salary' => $data['salary'],
                'salary_type' => 'monthly',
                'work_type' => $data['work'],
                'availability_status' => 'available',
                'immediate_availability' => true,
                'preferred_working_hours' => $data['time'][0] . '–' . $data['time'][1],
                'languages' => 'Hindi, Basic English',
                'address_line' => 'Fictional demo address, ' . $data['loc'],
                'pincode' => $locality->pincode,
                'profile_status' => 'active',
            ]);

            $sync = [];
            foreach ($data['services'] as $serviceIndex => $slug) {
                if (!isset($services[$slug])) continue;
                $sync[$services[$slug]->id] = [
                    'experience_years' => max(0, $data['exp'] - ($serviceIndex % 2)),
                    'service_rate' => $data['salary'],
                    'rate_type' => 'monthly',
                    'is_primary' => $serviceIndex === 0,
                    'notes' => 'Demo service association for development/testing.',
                ];
            }
            $profile->services()->sync($sync);

            $profile->availabilities()->delete();
            foreach ($data['days'] as $day) {
                HelperAvailability::create([
                    'helper_profile_id' => $profile->id,
                    'day_of_week' => $day,
                    'start_time' => $data['time'][0],
                    'end_time' => $data['time'][1],
                    'preference' => ((int) substr($data['time'][0], 0, 2) < 12) ? 'morning' : 'evening',
                ]);
            }
        }
    }
}
