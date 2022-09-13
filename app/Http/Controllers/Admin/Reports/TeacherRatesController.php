<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Http\Controllers\Controller;
use App\Models\College;
use App\Models\Episode;
use App\Models\Episode_student;
use App\Models\Episode_teacher;
use App\Models\Student;
use App\Models\Student_teacher_rate;
use App\Models\Teacher;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TeacherRatesController extends Controller
{
    public function index()
    {
        $data = [];
        $type = 'student';
        return view('admin.reports.teacher_rates.index', compact('data', 'type'));
    }

    public function search(Request $request)
    {
        $type = $request->type;
        $result = Student_teacher_rate::query();
        $result = $result->whereHas('Teacher',function ($q) use ($request) {
                        $q->where('first_name_ar', 'like', '%' . $request->teacher_name . '%')
                            ->orWhere('user_name', 'like', '%' . $request->teacher_name . '%')
                            ->orWhere('mid_name_ar', 'like', '%' . $request->teacher_name . '%')
                            ->orWhere('last_name_ar', 'like', '%' . $request->teacher_name . '%')
                            ->orWhere('first_name_en', 'like', '%' . $request->teacher_name . '%')
                            ->orWhere('mid_name_en', 'like', '%' . $request->teacher_name . '%')
                            ->orWhere('last_name_en', 'like', '%' . $request->teacher_name . '%')
                            ->orWhere('phone', 'like', '%' . $request->teacher_phone . '%')
                            ->orWhere('ident_num', 'like', '%' . $request->teacher_ident_num . '%');
                    });
        $data = $result->get();
        return view('admin.reports.teacher_rates.index', compact('data', 'type'));
    }

}
