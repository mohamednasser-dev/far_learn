<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Episode;
use App\Models\Episode_request;
use App\Models\Episode_student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Exception;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $type = null;
        $user_type =  auth()->guard('student')->user()->epo_type;
        if($user_type == 'far_learn'){
            $type = 'mqraa';
        }elseif($user_type == 'dorr'){
            $type = 'dorr';
        }elseif($user_type == 'mogmaa'){
            $type = 'mogmaa';
        }
        $data = Episode::where('teacher_id','!=',null)->where('type',$type)->where('active','y')->where('deleted','0')->paginate(8);
//        $result = Episode::query();
//        $result = $result->where('active','y');
//        $search_query = $result;
        return view('student.search_episode.search',compact('data'));
    }
    public function store(Request $request)
    {
        $type = null;
        $user_type =  auth()->guard('student')->user()->epo_type;
        if($user_type == 'far_learn'){
            $type = 'mqraa';
        }elseif($user_type == 'dorr'){
            $type = 'dorr';
        }elseif($user_type == 'mogmaa'){
            $type = 'mogmaa';
        }
        $result = Episode::query();
        $result = $result->where('type',$type)->where('active','y')->where('deleted','0')->where('teacher_id','!=',null);

        if ($request->teacher_name != null) {
            $teacher_ids = Teacher::where('first_name_ar', 'like', '%' . $request->teacher_name . '%')
                ->orWhere('user_name', 'like', '%' . $request->teacher_name . '%')
                ->orWhere('mid_name_ar', 'like', '%' . $request->teacher_name . '%')
                ->orWhere('last_name_ar', 'like', '%' . $request->teacher_name . '%')
                ->orWhere('first_name_en', 'like', '%' . $request->teacher_name . '%')
                ->orWhere('mid_name_en', 'like', '%' . $request->teacher_name . '%')
                ->orWhere('last_name_en', 'like', '%' . $request->teacher_name . '%')->pluck('id')->toArray();
            $result = $result->whereIn('teacher_id', $teacher_ids);
        }
        if ($request->gender != 'on') {
            $result = $result->where('gender', $request->gender);
        }
        if ($request->level_id) {
            if($request->level_id != 'on'){
                if($request->level_id != 'all'){
                    $result = $result->where('level_id', $request->level_id);
                }
            }
        }
        if ($request->language != null) {
            $teacher_ids = Teacher::Where('main_lang', $request->language )->pluck('id')->toArray();
            $result = $result->whereIn('teacher_id', $teacher_ids);
        }

        if ($request->cost) {
            if($request->cost != 'on'){
                if($request->cost == 'cost'){
                    $result = $result->where('cost','!=','free');
                }else if($request->cost == 'free'){
                    $result = $result->where('cost','free');
                }
            }
        }

        $search_query = $result;
        $data = $result->paginate(10);
        return view('student.search_episode.search',compact('data','search_query'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function join($episode_id)
    {
        $epo =  Episode::findOrFail($episode_id);
        if(count($epo->Students) < $epo->student_number){
            try {
                $data['episode_id'] = $episode_id;
                $data['student_id'] = auth::guard('student')->user()->id;
                Episode_request::create($data);
                Alert::success(trans('s_admin.episode'), trans('s_admin.request_done_s'));
                return back();
            }catch(Exception $exception){
                Alert::warning(trans('s_admin.episode'), trans('s_admin.request_done_before_s'));
                return back();
            }
        }else{
            Alert::success(trans('s_admin.warning'), trans('s_admin.no_enght_place'));
            return back();
        }

    }

    public function join_again($episode_id)
    {
        $epo =  Episode::findOrFail($episode_id);
        if(count($epo->Students) < $epo->student_number){
           $epo = Episode_request::where( 'student_id' , auth::guard('student')->user()->id )->where('episode_id',$episode_id)->first();
            $epo->status = 'new';
            $epo->save();
            Alert::success(trans('s_admin.episode'), trans('s_admin.request_done_again_s'));
            return back();
        }else{
            Alert::success(trans('s_admin.warning'), trans('s_admin.no_enght_place'));
            return back();
        }

    }
    public function leave($episode_id)
    {
        Alert::success(trans('s_admin.leave_now'), trans('s_admin.requested_done'));
        return back();
    }

    public function teacher_info($teacher_id)
    {
        $data = Teacher::find($teacher_id);
        return view('student.search_episode.teacher_info',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Episode::findOrFail($id);
        return view('student.search_episode.details',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
