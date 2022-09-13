<?php

namespace App\Http\Controllers\Admin\web_settings;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Episode_rate_question;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class EpisodeQuestionsRatesController extends Controller
{
    //Slider Actions
    public function index(){
        $data = Episode_rate_question::where('deleted','0')->orderBy('created_at','desc')->get();
        return view('admin.web_settings.episode_rate_questions' ,compact('data'));
    }

    public function store(Request $request)
    {
        $data = $this->validate(\request(),
            [
                'name_ar' => 'required',
                'name_en' => 'required',
            ]);
        Episode_rate_question::create($data);
        Alert::success(trans('admin.add'), trans('admin.addedsuccess'));
        return back();
    }

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
    public function update(Request $request)
    {
        $data = $this->validate(\request(),
            [
                'name_ar' => 'required',
                'name_en' => 'required',
            ]);

        Episode_rate_question::where('id',$request->id )->update($data);
        Alert::success(trans('s_admin.update'), trans('s_admin.updated_s'));
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
        $player = Episode_rate_question::where('id', $id)->first();
        $player->deleted = '1';
        $player->save();
        session()->flash('success',  trans('admin.deleteSuccess'));
        return back();
    }
}
