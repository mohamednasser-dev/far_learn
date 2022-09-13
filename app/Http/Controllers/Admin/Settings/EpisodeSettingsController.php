<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\College;
use App\Models\Nationality;
use App\Models\Plan\Plan_surah;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class EpisodeSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function suar_index()
    {
        $data = Plan_surah::where('deleted','0')->orderBy('id','desc')->get();
        return view('admin.settings.episodes.suar_quran', compact('data'));
    }
    public function suar_store(Request $request)
    {
        $input = $request->all();
        Plan_surah::create($input);
        Alert::success(trans('admin.add'), trans('admin.addedsuccess'));
        return back();
    }

    public function suar_update(Request $request)
    {
        $input['name_ar'] = $request->name_ar;
        $input['name_en'] = $request->name_en;
        $input['ayat_num'] = $request->ayat_num;
        Plan_surah::where('id',$request->id)->update($input);
        Alert::success(trans('s_admin.update'), trans('s_admin.updted_s'));
        return back();
    }

    public function suar_delete($id)
    {
        $input['deleted'] = '1';
        Plan_surah::where('id',$id)->update($input);
        Alert::success(trans('s_admin.delete'), trans('s_admin.deleted_s'));
        return back();
    }

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
        //
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
        //
    }
}
