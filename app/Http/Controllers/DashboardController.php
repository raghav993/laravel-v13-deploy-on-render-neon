<?php
namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Favorite;
use App\Models\HelperProfile;
use App\Models\HelperRemark;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    private function role($role=null) {
        abort_unless(auth()->check(), 403);
        if ($role) abort_unless(auth()->user()->role === $role, 403);
    }

    public function index() {
        $this->role();
        return match(auth()->user()->role) {
            'admin' => $this->admin(),
            'helper' => $this->helper(),
            default => $this->customer(),
        };
    }

    private function customer() {
        $u=auth()->user();
        $bookings=$u->bookings()->with(['helper.user','service'])->latest()->take(5)->get();
        $favorites=$u->favorites()->with(['helper.user','helper.services','helper.locality.city'])->latest()->take(6)->get();
        $recommended=HelperProfile::with(['user','services','locality.city'])->active()->latest()->take(6)->get();
        $contactRequests = \App\Models\ContactRequest::where('customer_id', $u->id)->with('helperProfile.user:id,name')->latest()->take(8)->get();
        return view('dashboard.customer', compact('bookings','favorites','recommended','contactRequests'));
    }

    private function helper() {
        $u=auth()->user(); $p=$u->helperProfile;
        abort_unless($p,404);
        $bookings=$p->bookings()->with(['customer','service'])->latest()->take(8)->get();
        $remarks=$p->remarks()->with('customer')->latest()->take(5)->get();
        $services=$p->services()->orderBy('name')->get();
        $contactRequests=\App\Models\ContactRequest::whereHas('helperProfile', fn($q)=>$q->where('user_id',$u->id))->with('customer:id,name')->latest()->take(8)->get();
        $completed=$p->bookings()->where('status','completed')->count();
        $earnings=$p->bookings()->where('status','completed')->sum('agreed_amount');
        return view('dashboard.helper', compact('p','bookings','remarks','services','contactRequests','completed','earnings'));
    }

    private function admin() {
        $stats=[
            'users'=>User::count(),
            'customers'=>User::where('role','customer')->count(),
            'helpers'=>User::where('role','helper')->count(),
            'pending_bookings'=>Booking::where('status','pending')->count(),
            'services'=>Service::count(),
            'testimonials'=>Testimonial::where('is_approved',false)->count(),
        ];
        $recentBookings=Booking::with(['customer','helper.user','service'])->latest()->take(8)->get();
        $recentUsers=User::latest()->take(6)->get();
        return view('dashboard.admin', compact('stats','recentBookings','recentUsers'));
    }

    public function profile() {
        $this->role(); $u=auth()->user();
        return view('dashboard.profile', ['u'=>$u,'services'=>Service::where('is_active',true)->orderBy('name')->get()]);
    }

    public function updateProfile(Request $r) {
        $this->role(); $u=auth()->user();
        $data=$r->validate(['name'=>'required|string|max:120','phone'=>'required|string|max:20|unique:users,phone,'.$u->id,'email'=>'required|email|max:255|unique:users,email,'.$u->id]);
        if (array_key_exists('phone', $data) && $data['phone'] !== $u->phone) {
            $data['phone_verified_at'] = null;
        }
        $u->update($data);
        if($u->isHelper()) {
            $p=$u->helperProfile; $p->update($r->validate([
                'bio'=>'nullable|string|max:2000','experience_years'=>'nullable|integer|min:0|max:60',
                'languages'=>'nullable|string|max:255','address_line'=>'nullable|string|max:255','pincode'=>'nullable|string|max:10',
                'expected_salary'=>'nullable|numeric|min:0','salary_type'=>'nullable|in:monthly,daily,hourly',
                'work_type'=>'nullable|in:full_time,part_time','availability_status'=>'nullable|in:available,busy,unavailable',
                'preferred_working_hours'=>'nullable|string|max:100'
            ]));
        } else {
            $u->customerProfile?->update($r->only(['address_line','pincode','locality_id']));
        }
        if($r->filled('password')) {
            $r->validate(['password'=>'min:8|confirmed']); $u->update(['password'=>$r->password]);
        }
        return back()->with('success','आपका profile सफलतापूर्वक update हो गया है।');
    }

    public function photo(Request $r) {
        $this->role(); $r->validate(['photo'=>'required|image|max:2048']);
        $u=auth()->user();
        if($u->isHelper()){
            $p=$u->helperProfile; $p->profile_photo=$r->file('photo')->store('helpers','public'); $p->save();
        }
        return back()->with('success','Profile photo सफलतापूर्वक update हो गई है।');
    }

    public function book(Request $r, HelperProfile $helper) {
        $this->role('customer');
        $data=$r->validate(['service_id'=>'required|exists:services,id','booking_date'=>'nullable|date|after_or_equal:today','start_time'=>'nullable','duration_hours'=>'nullable|integer|min:1|max:24','customer_note'=>'nullable|string|max:1000']);
        $data['customer_id']=auth()->id(); $data['helper_profile_id']=$helper->id; $data['status']='pending';
        Booking::create($data);
        return back()->with('success','Booking request सफलतापूर्वक भेज दी गई है। Helper के response का इंतजार करें।');
    }

    public function bookingStatus(Request $r, Booking $booking) {
        $u=auth()->user();
        abort_unless($u->isAdmin() || $booking->customer_id===$u->id || $booking->helper?->user_id===$u->id,403);
        $r->validate(['status'=>'required|in:accepted,rejected,confirmed,completed,cancelled','helper_note'=>'nullable|string|max:1000','admin_note'=>'nullable|string|max:1000']);
        $booking->update($r->only(['status','helper_note','admin_note']));
        return back()->with('success','Booking status सफलतापूर्वक update हो गया है।');
    }

    public function favorite(HelperProfile $helper) {
        $this->role('customer');
        Favorite::firstOrCreate(['customer_id'=>auth()->id(),'helper_profile_id'=>$helper->id]);
        return back()->with('success','Helper को favourites में save कर लिया गया है।');
    }
    public function unfavorite(HelperProfile $helper) {
        $this->role('customer'); Favorite::where(['customer_id'=>auth()->id(),'helper_profile_id'=>$helper->id])->delete();
        return back()->with('success','Helper को favourites से हटा दिया गया है।');
    }

    public function remark(Request $r, HelperProfile $helper) {
        $this->role('customer');
        $d=$r->validate(['rating'=>'nullable|integer|min:1|max:5','remark'=>'required|string|max:2000','booking_id'=>'nullable|exists:bookings,id']);
        HelperRemark::create($d+['customer_id'=>auth()->id(),'helper_profile_id'=>$helper->id]);
        return back()->with('success','आपका review/remark सफलतापूर्वक submit हो गया है।');
    }

    public function helperServices(Request $r) {
        $this->role('helper'); $p=auth()->user()->helperProfile;
        $d=$r->validate(['service_ids'=>'array','service_ids.*'=>'exists:services,id','primary_service'=>'nullable|exists:services,id']);
        $sync=[];
        foreach(($d['service_ids']??[]) as $id) $sync[$id]=['is_primary'=>(int)$id===(int)($d['primary_service']??0)];
        $p->services()->sync($sync);
        return back()->with('success','आपकी services सफलतापूर्वक update हो गई हैं।');
    }

    public function availability(Request $r) {
        $this->role('helper'); $p=auth()->user()->helperProfile;
        $d=$r->validate(['availability_status'=>'required|in:available,busy,unavailable','immediate_availability'=>'nullable']);
        $p->update(['availability_status'=>$d['availability_status'],'immediate_availability'=>$r->boolean('immediate_availability')]);
        return back()->with('success','आपकी availability सफलतापूर्वक update हो गई है।');
    }

    // Admin
    public function users(Request $r) {
        $this->role('admin');
        $q=User::with(['helperProfile','customerProfile'])->latest();
        if($r->filled('role')) $q->where('role',$r->role);
        if($r->filled('search')) $q->where(fn($x)=>$x->where('name','like','%'.$r->search.'%')->orWhere('email','like','%'.$r->search.'%')->orWhere('phone','like','%'.$r->search.'%'));
        $users=$q->paginate(15)->withQueryString(); return view('dashboard.admin.users',compact('users'));
    }
    public function userUpdate(Request $r, User $user) {
        $this->role('admin');
        $d=$r->validate(['name'=>'required|max:120','email'=>'required|email|unique:users,email,'.$user->id,'phone'=>'nullable|max:20|unique:users,phone,'.$user->id,'role'=>'required|in:customer,helper,admin','phone_verified'=>'nullable|boolean']);
        $d['phone_verified_at'] = $r->boolean('phone_verified') ? ($user->phone !== $d['phone'] ? null : ($user->phone_verified_at ?: now())) : null;
        unset($d['phone_verified']);
        $user->update($d); return back()->with('success','User details सफलतापूर्वक update हो गई हैं।');
    }
    public function services() {
        $this->role('admin'); $categories=ServiceCategory::with('services')->orderBy('sort_order')->get();
        return view('dashboard.admin.services',compact('categories'));
    }
    public function serviceStore(Request $r) {
        $this->role('admin');
        $d=$r->validate(['service_category_id'=>'required|exists:service_categories,id','name'=>'required|max:120','name_hi'=>'nullable|max:120','slug'=>'required|max:150|unique:services,slug','description'=>'nullable|max:1000']);
        Service::create($d+['is_active'=>$r->boolean('is_active',true)]); return back()->with('success','नई service सफलतापूर्वक add हो गई है।');
    }
    public function serviceUpdate(Request $r, Service $service) {
        $this->role('admin');
        $d=$r->validate(['service_category_id'=>'required|exists:service_categories,id','name'=>'required|max:120','name_hi'=>'nullable|max:120','slug'=>'required|max:150|unique:services,slug,'.$service->id,'description'=>'nullable|max:1000']);
        $service->update($d+['is_active'=>$r->boolean('is_active')]); return back()->with('success','Service सफलतापूर्वक update हो गई है।');
    }
    public function serviceDelete(Service $service){$this->role('admin');$service->delete();return back()->with('success','Service सफलतापूर्वक remove कर दी गई है।');}

    public function testimonials() {
        $this->role('admin'); $testimonials=Testimonial::with('user')->latest()->paginate(12);
        return view('dashboard.admin.testimonials',compact('testimonials'));
    }
    public function testimonialStore(Request $r) {
        $this->role('admin');
        $d=$r->validate(['name'=>'required|max:120','role_label'=>'nullable|max:120','message'=>'required|max:1000','rating'=>'required|integer|min:1|max:5','photo'=>'nullable|image|max:2048']);
        if($r->hasFile('photo')) $d['photo']=$r->file('photo')->store('testimonials','public');
        Testimonial::create($d+['is_approved'=>$r->boolean('is_approved')]); return back()->with('success','Testimonial सफलतापूर्वक save हो गया है।');
    }
    public function testimonialApprove(Testimonial $testimonial){$this->role('admin');$testimonial->update(['is_approved'=>!$testimonial->is_approved]);return back()->with('success','Testimonial approval status update हो गया है।');}
    public function testimonialDelete(Testimonial $testimonial){$this->role('admin');$testimonial->delete();return back()->with('success','Testimonial सफलतापूर्वक delete कर दिया गया है।');}

    public function settings() {
        $this->role('admin'); $settings=SiteSetting::all()->keyBy('key'); return view('dashboard.admin.settings',compact('settings'));
    }
    public function settingsSave(Request $r) {
        $this->role('admin');
        $d=$r->validate(['site_name'=>'nullable|max:120','tagline'=>'nullable|max:255','primary_color'=>'nullable|max:30','theme_mode'=>'nullable|in:light,dark,system','hero_title'=>'nullable|max:255','hero_text'=>'nullable|max:1000','logo'=>'nullable|image|max:2048','banner'=>'nullable|image|max:4096']);
        foreach(['site_name','tagline','primary_color','theme_mode','hero_title','hero_text'] as $key) if(array_key_exists($key,$d)) SiteSetting::set($key,$d[$key]??'');
        foreach(['logo','banner'] as $key) if($r->hasFile($key)) SiteSetting::set($key,$r->file($key)->store('site','public'),'image');
        return back()->with('success','Site settings सफलतापूर्वक save हो गई हैं।');
    }
    public function bookings(Request $r) {
        $this->role('admin'); $bookings=Booking::with(['customer','helper.user','service'])->latest()->paginate(15)->withQueryString();
        return view('dashboard.admin.bookings',compact('bookings'));
    }
}
