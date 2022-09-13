<?php

namespace App\Http\Controllers;

use App\Models\Certificat;
use App\Models\City;
use App\Models\District;
use App\Models\Subject;
use App\Models\Subject_level;
use App\Models\Zone;
use App\Notifications\ForgetPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Slider;
use App\Models\Blog;
use App\Models\User;
use Carbon\Carbon;
use DB;

class HomeController extends Controller
{

    public function __construct()
    {
        if (session()->has('lang')) {
        } else {
            session()->put('lang', 'ar');
        }
    }

    public function forgetPassword()
    {
        return view('front.login.forgetpassword');
    }
    public function terms()
    {
        return view('front.terms');
    }

    public function resetPassword(Request $request)
    {
        if ($user = User::where('email', '=', $request->email)->first()) {
            $type = 'users';
        } else if ($user = Student::where('email', '=', $request->email)->first()) {
            $type = 'students';
        } else if ($user = Teacher::where('email', '=',email)->first()) {
            $type = 'teachers';
        } else {
            Alert::error(trans('s_admin.not_here'), trans('s_admin.no_user_here'));
            return back();
        }
        //Create Password Reset Token
        DB::table('password_resets')->insert([
            'email' => $user->email,
            'token' => str_random(60),
            'created_at' => Carbon::now()
        ]);
        //Get the token just created above
        $tokenData = DB::table('password_resets')
            ->where('email', $user->email)->first();
        if ($this->sendResetEmail($user, $tokenData->token, $type ,$request->email)) {
            return redirect()->back()->with('status', trans('s_admin.code_return_pass'));
        } else {
            return redirect()->back()->withErrors(['error' => trans('s_admin.wrong_exists')]);
        }
    }

    private function sendResetEmail($user, $token, $type ,$username)
    {
        //Retrieve the user from the database

        //Generate, the password reset link. The token generated is embedded in the link
        $link = env('APP_URL') . 'password/reset/' . $token . '?email=' . urlencode($user->email) . '&type=' . $type . '&unique_name=' . $username;

        try {
            $email = $user->email;
            if($user->main_lang == 'ar'){
                //mailHere
                $data_verify['link'] = $link;
                $data_verify['type'] = $type;
                $data_verify['text'] = 'لاسترجاع كلمة المرور الرجاء الضغط على هذا الرابظ: ';
                $data_verify['lang'] = $user->main_lang;
                $data_verify['email'] = $email;
                $user->notify(new ForgetPassword($data_verify));
            }else{
                //mailHere
                $data_verify['link'] = $link;
                $data_verify['type'] = $type;
                $data_verify['text'] = 'To retrieve your password, please click on this link : ';
                $data_verify['lang'] = $user->main_lang;
                $data_verify['email'] = $email;
                $user->notify(new ForgetPassword($data_verify));
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function changePasswordForRest(Request $request)
    {
        //Validate input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'token' => 'required',
            'type' => 'required',
            'unique_name' => 'required',
        ]);


        $password = $request->password;
        // Validate the token
        $tokenData = DB::table('password_resets')
            ->where('token', $request->token)->first();
        // Redirect the user back to the password reset request form if the token is invalid
        if (!$tokenData) return view('auth.passwords.email');

            $password = \Hash::make($password);

            $user = User::where('email', $request->unique_name)->first();
            if($user){
                //Hash and update the new password
                $user->password = $password;
                $user->update(); //or $user->save();
            }

            $student = Student::where('email', $request->unique_name)->first();
            if($student){
                //Hash and update the new password
                $student->password = $password;
                $student->update(); //or $user->save();
            }

            $teacher = Teacher::where('email', $request->unique_name)->first();
            if($teacher){
                //Hash and update the new password
                $teacher->password = $password;
                $teacher->update(); //or $user->save();
            }


        // Redirect the user back if the email is invalid
//        if (!$user) return redirect()->back()->withErrors(['email' => 'Email not found']);


        //login the user immediately they change password successfully

        //Delete the token
        DB::table('password_resets')->where('email', $request->unique_name)
            ->delete();

        //Send Email Reset Success Email
        Alert::success(trans('s_admin.success_operation'), trans('s_admin.password_reset_s'));

        return redirect('/');
    }


    public function main_pge()
    {
        if (session()->has('lang')) {
        } else {
            session()->put('lang', 'en');
        }
        $sliders = Slider::where('status', 'active')->get();
        $blogs = Blog::where('status', 'active')->get();
        $teachers = Teacher::where('member', 1)->where('status', 'active')->where('is_new', 'accepted')->where('is_verified', '1')->get();
        return view('front.index', compact('sliders', 'blogs', 'teachers'));
    }

    public function student()
    {
        return view('student.home');
    }

    public function lang($lang){
        if (session()->has('lang')) {
            session()->forget('lang');
        }
        session()->put('lang', $lang);
        \App::setLocale($lang);
        if(\Auth::guard('web')->check()){
            $user = User::whereId(auth()->guard('web')->user()->id)->first();
            $user->main_lang = $lang ;
            $user->save();
        }else if(\Auth::guard('teacher')->check()){
            $user = Teacher::whereId(auth()->guard('teacher')->user()->id)->first();
            $user->main_lang = $lang ;
            $user->save();
        }else if(\Auth::guard('student')->check()){
            $user = Student::whereId(auth()->guard('student')->user()->id)->first();
            $user->main_lang = $lang ;
            $user->save();
        }
        return redirect()->back();
    }

    public function teaching_members()
    {
        $data = Teacher::where('status', 'active')->where('is_new', 'accepted')->where('is_verified', '1')->get();
        return view('front.teachers', compact('data'));
    }

    // verify by sms ...
    public function reverify_account($id , $code){
//        $student = Student::find($id);
//        return view('front.login.verify_by_sms', compact('student'));

        $student = Student::where('code',$code)->where('id',$id)->first();
        if($student){
            $new_data['code'] = null;
            $new_data['is_verified'] = "1";
            Student::where('code',$code)->where('id',$id)->update($new_data);
            //auto login after verification ..
            if (auth::guard('student')->attempt(['unique_name' => $student->unique_name , 'email' => $student->email ])) {
                if (auth()->guard('student')->user()->parent_data == 'not_complete') {
                    $student_id = auth()->guard('student')->user()->id;
                    Auth::guard('student')->logout();
                    Alert::warning(trans('s_admin.warning'), trans('admin.you_should_complete_parent_data'));
                    return redirect(url('/' . $student_id . '/student_parent'));
                }elseif (auth()->guard('student')->user()->is_verified == '0') {
                    $email = auth()->guard('student')->user()->email;
                    Auth::guard('student')->logout();
                    Alert::warning(trans('s_admin.warning'), trans('s_admin.you_should_active'));
                    $person_type = 'student';
                    return view('front.login.verify_email', compact('email', 'person_type'));
                }elseif (auth()->guard('student')->user()->is_new == 'rejected') {
                    Auth::guard('student')->logout();
                    Alert::warning(trans('s_admin.confirmation_acc'), trans('s_admin.you_rejected'));
                    return back();
                }
                //Check if active user or not
                if (auth()->guard('student')->user()->status != 'active') {
                    Auth::guard('student')->logout();
                    Alert::warning(trans('s_admin.activation'), trans('s_admin.you_not_active'));
                    return back();
                } else {
                    Alert::success(trans('admin.login_done'), trans('admin.hello'));
                    return redirect('student/home');
                }
            }
//            Alert::success(trans('s_admin.success_operation'), trans('s_admin.account_checked_s'));
        }else{
            Alert::error(trans('s_admin.not_completed'), trans('s_admin.data_incorrect'));
        }
        return back();
    }
    public function reverify_account_store(Request $request){

        $student = Student::where('code',$request->code)->where('id',$request->student_id)->first();
        if($student){
            $new_data['code'] = null;
            $new_data['is_verified'] = "1";
            $student = Student::where('code',$request->code)->where('id',$request->student_id)->update($new_data);
            Alert::success(trans('s_admin.success_operation'), trans('s_admin.account_checked_s'));
        }else{
            Alert::error(trans('s_admin.not_completed'), trans('s_admin.data_incorrect'));
        }
        return back();
    }
    public function get_zones(Request $request, $id)
    {
        $data = Zone::where('country_id', $id)->get();
        return view('admin.reports.data.parts.zones', compact('data'));
    }

    public function get_cities(Request $request, $id)
    {
        $data = City::where('zone_id', $id)->get();
        return view('admin.reports.data.parts.cities', compact('data'));
    }

    public function get_districts(Request $request, $id)
    {
        $data = District::where('city_id', $id)->get();
        return view('admin.reports.data.parts.districts', compact('data'));
    }

    public function get_subjects(Request $request,$id)
    {
        $data = Subject::where('level_id',$id)->get();
        return view('student.profile.parts.subjects',compact('data'));
    }
    public function get_subject_levels(Request $request,$id)
    {
        $data = Subject_level::where('subject_id',$id)->get();
        return view('student.profile.parts.subject_levels',compact('data'));
    }

    public function download_certificate($id)
    {
        $certificat =  Certificat::findOrFail($id);
        return view('admin.episodes.certificats.download',compact('certificat'));
    }
}
