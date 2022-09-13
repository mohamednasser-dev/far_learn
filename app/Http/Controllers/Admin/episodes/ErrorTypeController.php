<?php

namespace App\Http\Controllers\Admin\episodes;

use App\Http\Controllers\Controller;
use App\ErrorType;
use App\Models\Far_learn_degree;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ErrorTypeController extends Controller
{
    public function ErrorType_index()
    {
        $data = ErrorType::where('deleted','0')->orderBy('id','desc')->get();
        return view('admin.episodes.mogma_dorr_evaluations.ErrorType', compact('data'));
    }
    public function ErrorType_store(Request $request)
    {
        $input = $request->all();
        ErrorType::create($input);
        Alert::success(trans('admin.add'), trans('admin.addedsuccess'));
        return back();
    }
    public function ErrorType_update(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);
        ErrorType::where('id',$request->id)->update($input);
        Alert::success(trans('s_admin.update'), trans('s_admin.updted_s'));
        return back();
    }
    public function ErrorType_delete(Request $request,$id)
    {
        $input['deleted'] = '1';
        ErrorType::where('id',$id)->update($input);
        Alert::success(trans('s_admin.delete'), trans('s_admin.deleted_s'));
        return back();
    }


    // for far learn
    public function far_episode_ErrorType_index()
    {
        $data = Far_learn_degree::where('deleted','0')->orderBy('id','desc')->get();
        return view('admin.episodes.far_learn.degrees', compact('data'));
    }
    public function far_episode_ErrorType_store(Request $request)
    {
        $input = $request->all();
        Far_learn_degree::create($input);
        Alert::success(trans('admin.add'), trans('admin.addedsuccess'));
        return back();
    }
    public function far_episode_ErrorType_update(Request $request)
    {
        $input['name_ar'] = $request->name_ar;
        $input['name_en'] = $request->name_en;
        Far_learn_degree::where('id',$request->id)->update($input);
        Alert::success(trans('s_admin.update'), trans('s_admin.updted_s'));
        return back();
    }
    public function far_episode_ErrorType_delete(Request $request,$id)
    {
        $input['deleted'] = '1';
        Far_learn_degree::where('id',$id)->update($input);
        Alert::success(trans('s_admin.delete'), trans('s_admin.deleted_s'));
        return back();
    }
}
