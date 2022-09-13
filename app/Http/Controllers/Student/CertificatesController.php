<?php

namespace App\Http\Controllers\Student;
use App\Models\Admin_notification;
use App\Models\Certificat;
use App\Models\Notification;
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

class CertificatesController extends Controller
{

    public function index()
    {
        $data = Certificat::where('student_id',auth::guard('student')->user()->id)->orderBy('created_at','desc')->get();
        Certificat::where('student_id',auth::guard('student')->user()->id)->orderBy('created_at','desc')->update(['student_view'=>1]);
Notification::where('student_id',auth::guard('student')->user()->id)->where('message_type','certificate')->update(['readed'=> '1']);
        return view('student.certificate.index',compact('data'));
    }


}
