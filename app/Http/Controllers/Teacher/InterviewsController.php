<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Teacher_interview;
use App\Models\Teacher_request;
use Illuminate\Support\Facades\Auth;

class InterviewsController extends Controller
{
    public function index()
    {
        $id =auth::guard('teacher')->user()->id;
        $update_data['readed'] = '1';
        Notification::where('teacher_id',$id)->where('message_type', 'teacher_zoom')->where('readed', '0')->update($update_data);

        $data = Teacher_interview::where('teacher_id',auth()->guard('teacher')->user()->id)->orderBy('created_at','desc')->get();
        return view('teacher.interview.index', compact('data'));
    }

    public function zoom_room($id)
    {
        //zoom_room
        $data = Teacher_interview::whereId($id)->first();
        return view('teacher.interview.zoom_room',compact('data'));
    }

    public function zoom($id)
    {
        //zoom_room
        $data = Teacher_interview::whereId($id)->first();
        return view('teacher.episodes.zoom',compact('data'));
    }


}
