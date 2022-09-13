<?php

namespace App\Http\Controllers\Admin\episodes;
use App\Http\Controllers\Controller;
use App\Models\day;
use App\Models\Episode_day;
use App\Models\Episode_section;
use App\Models\Episode_student;
use App\Models\Plan_section_degree;
use App\Models\Subject_level;
use Illuminate\Http\Request;
use App\Models\Episode;
use App\Models\Subject;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class EpisodeStudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Episode_student::all();
        return view('admin.episodes.episod_students.index' ,compact('data') );
    }

    public function student_degrees($stud_id,$epo_id)
    {
        $episode = Episode::find($epo_id);
        $sections = Episode_section::where('episode_id',$epo_id)->select('id')->get()->toArray();
        $data = Plan_section_degree::where('student_id',$stud_id)
            ->wherein('section_id',$sections)
            ->orderBy('created_at','desc')
            ->get();
        return view('admin.episodes.student_degrees',compact('data','episode'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.episodes.index_create' );
    }
    public function create_mqraa()
    {
        return view('admin.episodes.create_mqraa' );
    }

    public function index_create_mogmaa()
    {
        return view('admin.episodes.index_create_mogmaa' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate(\request(),
            [
                'name_ar' => 'required',
                'name_en' => 'required',
                'gender' => 'required',
                'level_id' => 'required',
                'subject_id' => 'required',
                'subject_level_id' => 'required',
                'teacher_id' => 'required',
                'student_number' => 'required',
                'listen_type' => 'required',
                'active' => 'required',
                'desc_ar' => 'required',
                'desc_en' => 'required',
                'time_from' => 'required',
                'time_to' => 'required',
                'student_link' => 'required',
                'teacher_link' => 'required'
            ]);

        $data['time_from'] = Carbon::createFromTimestamp($request->time_from);
        $data['time_to'] = Carbon::createFromTimestamp($request->time_to);
        $episode = Episode::create($data);
        foreach ($request->days as $day){
            $day_data['day_id'] = $day;
            $day_data['episode_id'] = $episode->id;
            Episode_day::create($day_data);
        }
        Alert::success(trans('admin.add'), trans('admin.addedsuccess'));
        return back();
    }
    public function get_subjects(Request $request,$id)
    {
        $data = Subject::where('level_id',$id)->get();
        return view('admin.episodes.parts.subjectOptions',compact('data'));
    }
    public function get_subject_levels(Request $request,$id)
    {
        $data = Subject_level::where('subject_id',$id)->get();
        return view('admin.episodes.parts.subject_levelsOptions',compact('data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $epo_students = Episode_student::where('id', $id)->first();
        $epo_students->deleted = '1';
        $epo_students->save();
        Alert::success(trans('s_admin.success'), trans('s_admin.deleted_s'));
        return back();
    }
}
