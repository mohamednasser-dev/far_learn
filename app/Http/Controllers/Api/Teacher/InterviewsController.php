<?php

namespace App\Http\Controllers\Api\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Resources\InterviewsResource;
use App\Models\Teacher_interview;
use Illuminate\Http\Request;

class InterviewsController extends Controller
{
    public function index(Request $request)
    {
        $user = check_api_token($request->header('apitoken'));
        if ($user && $user->type == 'teacher') {

            $data = Teacher_interview::where('teacher_id', $user->id)->paginate(10);
            $data = InterviewsResource::collection($data)->response()->getData(true);
            return msgdata($request, success(), trans('s_admin.shown_s'), $data);
        } else {
            return msgdata($request, not_authoize(), trans('s_admin.not_authorize'), (object)[]);
        }

    }
}
