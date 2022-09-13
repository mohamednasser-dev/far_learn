<?php

namespace App\Http\Controllers\Student;
use App\Models\Admin_notification;
use App\Models\Plan_section_degree;
use App\Models\Student;
use App\Models\Teacher_request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Alkoumi\LaravelHijriDate\Hijri;
use Illuminate\Http\Request;
use App\Models\Teacher;

class ReportsController extends Controller
{

    public function index()
    {
        $data= Plan_section_degree::whereDate('created_at', Carbon::now())->where('student_id',auth::guard('student')->user()->id)->where('type','!=','absence')->get();
        $today_date = Carbon::now() ;
        return view('student.reports.index',compact('data','today_date'));
    }

    public function search(Request $request)
    {
        $data= Plan_section_degree::whereDate('created_at',$request->selected_date)->where('student_id',auth::guard('student')->user()->id)->where('type','!=','absence')->get();
        $today_date = $request->selected_date ;
        return view('student.reports.index',compact('data','today_date'));
    }

}
