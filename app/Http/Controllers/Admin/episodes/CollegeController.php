<?php

namespace App\Http\Controllers\Admin\episodes;

use App\Http\Controllers\Controller;
use App\Models\College;
use App\Models\Episode;
use App\Models\Episode_day;
use App\Models\Nationality;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CollegeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \auth()->user();
        if($user->role_id == 3 || $user->role_id == 5||$user->role_id == 9 || $user->role_id == 10||$user->role_id == 11 ||
        $user->role_id == 12||$user->role_id == 13 || $user->role_id == 14){
            $data = College::where('id',$user->college_id)->where('deleted', '0')->get();
        }else{
            $data = College::where('type', 'college')->where('deleted', '0')->get();
        }
        return view('admin.episodes.college.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.episodes.college.create');
    }

    public function create_custom($college_id)
    {
        return view('admin.episodes.college.create', compact('college_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate(\request(),
            [
                'name_ar' => 'required',
                'name_en' => 'required',
                'type' => 'required',
                'mosque_name' => '',
                'teacher_id' => '',
                'mogmaa_time' => 'required',
                'mogmaa_type' => '',
                'study_days' => 'required',
                'study_period' => 'required',
                'episode_form' => '',
            ]);

        $data['study_days'] = json_encode($data['study_days']);
        $data['study_period'] = json_encode($data['study_period']);

        College::create($data);
        Alert::success(trans('admin.add'), trans('admin.addedsuccess'));
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Episode::where('college_id', $id)->where('deleted', '0')->get();
        $college_id = $id;
        return view('admin.episodes.college.episodes', compact('data', 'college_id'));
    }

    public function episodes($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = College::findOrFail($id);
        $data->study_days = json_decode($data->study_days);
        $data->study_period = json_decode($data->study_period);
        return view('admin.episodes.college.edit', compact('data'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $data = $this->validate(\request(),
            [
                'name_ar' => 'required',
                'name_en' => 'required',
                'type' => 'required',
                'mosque_name' => 'nullable',
                'teacher_id' => 'nullable',
                'mogmaa_time' => 'required',
                'mogmaa_type' => 'nullable',
                'study_days' => 'required',
                'study_period' => 'required',
                'episode_form' => 'nullable',
            ]);

        $data['study_days'] = json_encode($data['study_days']);
        $data['study_period'] = json_encode($data['study_period']);


         College::where('id', $request->id)->update($data);

        Alert::success(trans('s_admin.update'), trans('s_admin.updted_s'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data['deleted'] = '1';
            College::where('id', $id)->update($data);
            Alert::success(trans('admin.delete'), trans('s_admin.deleted_s'));
        } catch (Exception $exception) {
            Alert::error(trans('admin.delete'), trans('s_admin.ther_some_data_on_it'));
        }
        return back();
    }
}
