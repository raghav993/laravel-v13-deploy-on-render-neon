<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use App\Models\User;

class DashboardDemoSeeder extends Seeder {
    public function run(): void {
        $settings=[
            'site_name'=>['Sahayika','text'],
            'tagline'=>['हर घर के लिए, भरोसेमंद मदद।','text'],
            'theme_mode'=>['light','text'],
            'primary_color'=>['#2f6e68','text'],
            'hero_title'=>['भरोसे की सहायिका ढूंढें।','text'],
            'hero_text'=>['घर की सफाई, खाना, बच्चों और बुज़ुर्गों की देखभाल के लिए verified-style local profiles देखें।','text'],
        ];
        foreach($settings as $k=>$v) SiteSetting::set($k,$v[0],$v[1]);
        $admin=User::where('role','admin')->first();
        foreach([
            ['Neha Verma','Customer · Indore','Sahayika ने घर की सफाई के लिए सही helper खोजने में बहुत आसानी कर दी।',5],
            ['Amit Sharma','Customer · Vijay Nagar','Profile में experience और services साफ दिखाई देती हैं।',5],
            ['Pooja Mehta','Customer · Nipania','Booking request और remarks जैसे features बहुत useful हैं।',4],
        ] as $i=>$t) Testimonial::updateOrCreate(['name'=>$t[0]],['user_id'=>$admin?->id,'role_label'=>$t[1],'message'=>$t[2],'rating'=>$t[3],'is_approved'=>true,'sort_order'=>$i+1]);
    }
}
