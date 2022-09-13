<?php

namespace App\Http\Controllers\Api\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReportsResource;
use App\Models\Plan_section_degree;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportsController extends Controller
{
    public function index(Request $request)
    {
        $user = check_api_token($request->header('apitoken'));
        if ($user && $user->type == 'teacher') {
            if($request->date){
                $data= Plan_section_degree::whereDate('created_at', $request->date)->where('teacher_id',$user->id)->where('type','!=','absence')->get();

            }else{
                $data= Plan_section_degree::whereDate('created_at', Carbon::now())->where('teacher_id',$user->id)->where('type','!=','absence')->get();

            }
            $data = ReportsResource::collection($data)->response()->getData(true);
            return msgdata($request, success(), trans('s_admin.shown_s'), $data);
        } else {
            return msgdata($request, not_authoize(), trans('s_admin.not_authorize'), (object)[]);
        }
    }
}
