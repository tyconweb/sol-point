<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;
use App\PersonalEvent;
use App\User;
use App\LeaveApplication;
use App\Notice;
use App\Department;
use App\GeneralSetting;
use Carbon;
use Auth;

class HomeController extends Controller {

/**
 * Create a new controller instance.
 *
 * @return void
 */
	public function __construct() {
		$this->middleware('auth');
	}

/**
 * Show the application dashboard.
 *
 * @return \Illuminate\Http\Response
 */
	public function index() {
		$today = Carbon\Carbon::now();
		$date_today = $today->toDateString();

		$personal_events = PersonalEvent::query()
			->leftjoin('users as users', 'users.id', '=', 'personal_events.created_by')
			->orderBy('personal_events.start_date', 'ASC')
			->where('personal_events.deletion_status', 0)
			->where('personal_events.start_date', '>=', $date_today)
			->get([
				'personal_events.*',
				'users.name',
			]);
		$notices = Notice::where('deletion_status', 0)->get();

		$leaves = LeaveApplication::where('deletion_status', 0);

		$employees = User::where('access_label', '>=', 2)
			->where('access_label', '<=', 3)
			->where('deletion_status', 0)
			->get();

		$job_groups = Department::where('deletion_status', 0)
			->get();
		$user = Auth::user();
		if ($user->access_label == 1) {
			$leaves = $leaves->get();
		}else{
			$leaves = $leaves->where('created_by',$user->id)->get();
		}

		return view('administrator.dashboard.dashboard', compact('notices', 'leaves', 'employees', 'personal_events', 'job_groups'));
	}
	public function cache_clear(){
		\Illuminate\Support\Facades\Artisan::call('clear-compiled');
		\Illuminate\Support\Facades\Artisan::call('optimize');
		\Illuminate\Support\Facades\Artisan::call('cache:clear');
		\Illuminate\Support\Facades\Artisan::call('config:cache');
		\Illuminate\Support\Facades\Artisan::call('config:clear');
		\Illuminate\Support\Facades\Artisan::call('view:clear');
		\Illuminate\Support\Facades\Artisan::call('route:clear');
		return 'Cleared!';		
	}
	public function logoUpdate(Request $request){
	    $request->validate([
	        'logo_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
	    ]);

	    $settings = GeneralSetting::first();
	    // print_r($settings); exit;

	    if ($request->hasFile('logo_image')) {
	        $logo_image = $request->file('logo_image');
	        $logo_image_name = time() . '.' . $logo_image->getClientOriginalExtension();
	        $logo_image_path = public_path('backend/img/' . $logo_image_name);
	        $logo_image->move(public_path('backend/img/'), $logo_image_name);

	        $imagePath = $logo_image_path; // Replace with your image path

	        $image = imagecreatefromstring(file_get_contents($imagePath));
	        $newImagePath = public_path('backend/img/' . 'corporatelogo.png');
	        imagepng($image, $newImagePath);
	        imagedestroy($image);

	        unlink($logo_image_path);

	        $settings->updated_by = \Auth::id();
	        $settings->save();
            \Illuminate\Support\Facades\Artisan::call('view:clear');
	        return redirect()->back()->with('success', 'Logo updated successfully.');
	    }
	}

}
