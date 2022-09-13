<?php

namespace App\Http\Controllers\Api\Students;


use App\Http\Resources\PlanSectionDegreeResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReportsResource;
use App\Models\Plan_section_degree;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class ReportsController extends Controller
{

    public function daily_recitation(Request $request)
    {
        $user = check_api_token($request->header('apitoken'));
        if ($user && $user->type == 'student') {
            $result = Plan_section_degree::query();
            if ($request->searched_date) {
                $result = $result->whereDate('created_at', $request->searched_date);
            }
            $result = $result->where('student_id', $user->id)->where('type', '!=', 'absence')->orderBy('created_at','desc')->paginate(10);
            $data = (PlanSectionDegreeResource::collection($result))->response()->getData(true);
            return msgdata($request, success(), trans('s_admin.shown_s'), $data);
        } elseif ($user && $user->type == 'teacher') {
            if ($request->date) {
                $data = Plan_section_degree::whereDate('created_at', $request->date)->where('teacher_id', $user->id)->where('type', '!=', 'absence')->orderBy('created_at','desc')->paginate(10);
            } else {
                $data = Plan_section_degree::where('teacher_id', $user->id)->where('type', '!=', 'absence')->orderBy('created_at','desc')->paginate(10);
            }
            $data = ReportsResource::collection($data)->response()->getData(true);
            return msgdata($request, success(), trans('s_admin.shown_s'), $data);
        } else {
            return msgdata($request, not_authoize(), trans('s_admin.not_authorize'), (object)[]);
        }
    }
}
