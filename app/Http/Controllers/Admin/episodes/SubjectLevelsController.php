<?php

namespace App\Http\Controllers\Admin\episodes;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Subject_level;
use http\Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SubjectLevelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Subject_level::where('deleted','0')->orderBy('id','asc')->get();
        return view('admin.episodes.levels.subjects.subject_levels.index' ,compact('data') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
                'desc_ar' => 'required',
                'desc_en' => 'required',
                'num_lines' => 'required',
                'num_faces' => 'required',
                'subject_id' => 'required'
            ]);
        Subject_level::create($data);
        Alert::success(trans('admin.add'), trans('admin.addedsuccess'));
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subject_id = $id;
        $subject = Subject::find($id);
        $data = Subject_level::where('deleted','0')->where('subject_id',$id)->orderBy('id','asc')->get();
        return view('admin.episodes.levels.subjects.subject_levels.index' ,compact('data','subject_id','subject') );
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
    public function update(Request $request)
    {
        $input['name_ar'] = $request->name_ar;
        $input['name_en'] = $request->name_en;
        $input['desc_ar'] = $request->name_en;
        $input['desc_en'] = $request->name_en;
        $input['num_lines'] = $request->num_lines;
        $input['num_faces'] = $request->num_faces;
        Subject_level::where('id',$request->id)->update($input);
        Alert::success(trans('s_admin.update'), trans('s_admin.updted_s'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $data['deleted'] = '1';
            Subject_level::where('id', $id)->update($data);
            Alert::success(trans('admin.delete'), trans('s_admin.deleted_s'));
        }catch(Exception $exception){
            Alert::error(trans('admin.delete'), trans('s_admin.ther_some_data_on_it'));
        }
        return back();
    }
}
