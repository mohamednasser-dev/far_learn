<?php

namespace App\Http\Controllers\Admin\episodes;
use App\Models\Plan\Plan_surah;
use App\Models\Plan_episode_day;
use App\Models\Plan_section_degree;
use App\Models\Subject_level;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use App\Models\Plan\Plan_revision;
use App\Models\Plan\Plan_tracomy;
use App\Models\Plan\Plan_new;
use Illuminate\Http\Request;

class SubjectLevelDailyPlanController extends Controller
{
    public function validationErrorsToString($errArray){
        $valArr = array();
        foreach ($errArray->toArray() as $key => $value)
        {
            $errStr = $value[0];
            array_push($valArr, $errStr);
        }
        return $valArr;
    }
    public function makeValidate($inputs, $rules){
        $validator = Validator::make($inputs, $rules);
        if ($validator->fails())
        {
            return $this->validationErrorsToString($validator->messages());
        } else {
            return true;
        }
    }
    public function index()
    {
    }

    public function get_ayat_num(Request $request,$id)
    {
        $data = Plan_surah::where('id',$id)->first();
        $surah_num = $data->ayat_num +1;
        for($i = 1; $i < $surah_num ; $i++){
            $numbers[$i] = $i;
        }
        return view('admin.episodes.levels.subjects.subject_levels.daily_plan.parts.ayat_surah',compact('numbers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $sub_level_id = $id;
        $subject_level = Subject_level::find($id);
        return view('admin.episodes.levels.subjects.subject_levels.daily_plan.create',compact('sub_level_id','subject_level'));
    }


    public function store_plan_new(Request $request)
    {
        $input = $request->all();
        $validate = $this->makeValidate($input,[
            'week_id' => 'required',
            'day_id' => 'required',
            'from_surah_id' => 'required',
            'from_num' => 'required',
            'to_surah_id' => 'required',
            'to_num' => 'required',
            'sub_level_id' => 'required'
        ]);
        if (!is_array($validate))
        {
            $exists_plan = plan_new::where('week_id',$request->week_id)->where('day_id',$request->day_id)->where('sub_level_id',$request->sub_level_id)->first();
            if($exists_plan == null) {
                if($request->from_surah_id > $request->to_surah_id){
                    return response(['status' => false, 'msg' => trans('s_admin.dont_added_becase_of_sorting_sura')]);
                }
                if($request->from_surah_id == $request->to_surah_id){
                    if($request->from_num > $request->to_num){
                        return response(['status' => false, 'msg' => trans('s_admin.dont_added_becase_of_sorting_aya_sura')]);
                    }
                }

                $plan_new = Plan_new::create($request->all());
                if ($plan_new != null) {
                    return response(['status' => true, 'msg' => trans('s_admin.added_s2')]);
                } else {
                    return response(['status' => false, 'msg' => trans('s_admin.dont_added_s')]);
                }
            }else{
                return response(['status' => false, 'msg' => trans('s_admin.dont_added_to_exist_before')]);
            }
        } else {
            return response(['status' => false, 'msg' => $validate]);
        }
    }
    public function store_plan_tracomy(Request $request)
    {
        $input = $request->all();
        $validate = $this->makeValidate($input,[
            'week_id' => 'required',
            'day_id' => 'required',
            'from_surah_id' => 'required',
            'from_num' => 'required',
            'to_surah_id' => 'required',
            'to_num' => 'required',
            'sub_level_id' => 'required'
        ]);
        if (!is_array($validate))
        {
            $exists_plan = Plan_tracomy::where('week_id',$request->week_id)->where('day_id',$request->day_id)->where('sub_level_id',$request->sub_level_id)->first();
            if($exists_plan == null) {
                if($request->from_surah_id > $request->to_surah_id){
                    return response(['status' => false, 'msg' => trans('s_admin.dont_added_becase_of_sorting_sura')]);
                }
                if($request->from_surah_id == $request->to_surah_id){
                    if($request->from_num > $request->to_num){
                        return response(['status' => false, 'msg' => trans('s_admin.dont_added_becase_of_sorting_aya_sura')]);
                    }
                }
                $plan_tracomy = Plan_tracomy::create($request->all());
                if($plan_tracomy != null){
                    return response(['status' => true, 'msg' => trans('s_admin.added_s2')]);
                }else{
                    return response(['status' => false , 'msg' => trans('s_admin.dont_added_s')]);
                }
            }else{
                return response(['status' => false, 'msg' => trans('s_admin.dont_added_to_exist_before')]);
            }
        } else {
            return response(['status' => false, 'msg' => $validate]);
        }
    }
    public function store_plan_revision(Request $request)
    {
        $input = $request->all();
        $validate = $this->makeValidate($input,[
            'week_id' => 'required',
            'day_id' => 'required',
            'from_surah_id' => 'required',
            'from_num' => 'required',
            'to_surah_id' => 'required',
            'to_num' => 'required',
            'sub_level_id' => 'required'
        ]);
        if (!is_array($validate))
        {
            $exists_plan = Plan_revision::where('week_id',$request->week_id)->where('day_id',$request->day_id)->where('sub_level_id',$request->sub_level_id)->first();
            if($exists_plan == null) {
                if($request->from_surah_id > $request->to_surah_id){
                    return response(['status' => false, 'msg' => trans('s_admin.dont_added_becase_of_sorting_sura')]);
                }
                if($request->from_surah_id == $request->to_surah_id){
                    if($request->from_num > $request->to_num){
                        return response(['status' => false, 'msg' => trans('s_admin.dont_added_becase_of_sorting_aya_sura')]);
                    }
                }
                $plan_tracomy = Plan_revision::create($request->all());
                if ($plan_tracomy != null) {
                    return response(['status' => true, 'msg' => trans('s_admin.added_s2')]);
                } else {
                    return response(['status' => false, 'msg' => trans('s_admin.dont_added_s')]);
                }
            }else{
                return response(['status' => false, 'msg' => trans('s_admin.dont_added_to_exist_before')]);
            }
        } else {
            return response(['status' => false, 'msg' => $validate]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sub_level_id = $id;
        $subject_level = Subject_level::find($id);
        $new = Plan_new::where('sub_level_id',$id)->orderBy('week_id','asc')->orderBy('day_id','asc')->paginate(15);
        $tracomy = Plan_tracomy::where('sub_level_id',$id)->orderBy('week_id','asc')->orderBy('day_id','asc')->paginate(15);
        $revision = Plan_revision::where('sub_level_id',$id)->orderBy('week_id','asc')->orderBy('day_id','asc')->paginate(15);
        return view('admin.episodes.levels.subjects.subject_levels.daily_plan.index' ,compact('subject_level','revision','tracomy','new','sub_level_id') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_new($id)
    {
        $new_data_epo = Plan_episode_day::where('plan_id',$id)->where('plan_type','new')->get();
        $new_data = Plan_section_degree::where('plan_id',$id)->where('plan_type','new')->get();
        if(count($new_data_epo) > 0 || count($new_data) > 0){
            Alert::error(trans('admin.delete'), trans('s_admin.not_deleted_used'));
        }else{
            $deleted = Plan_new::where('id',$id)->delete();
            if($deleted != null){
                Alert::success(trans('admin.delete'), trans('s_admin.deleted_s'));
            }else{
                Alert::error(trans('admin.delete'), trans('s_admin.not_deleted'));
            }
        }
        return back();
    }
    public function delete_tracomy($id)
    {
        $tracomy_data_epo = Plan_episode_day::where('plan_id',$id)->where('plan_type','tracomy')->get();
        $tracomy_data = Plan_section_degree::where('plan_id',$id)->where('plan_type','tracomy')->get();
        if(count($tracomy_data_epo) > 0 || count($tracomy_data) > 0){
            Alert::error(trans('admin.delete'), trans('s_admin.not_deleted_used'));
        }else{
            $deleted = Plan_tracomy::where('id',$id)->delete();
            if($deleted != null){
                Alert::success(trans('admin.delete'), trans('s_admin.deleted_s'));
            }else{
                Alert::error(trans('admin.delete'), trans('s_admin.not_deleted'));
            }
        }
        return back();
    }
    public function delete_revision($id)
    {
        $revision_data_epo = Plan_episode_day::where('plan_id',$id)->where('plan_type','revision')->get();
        $revision_data = Plan_section_degree::where('plan_id',$id)->where('plan_type','revision')->get();
        if(count($revision_data_epo) > 0 || count($revision_data) > 0){
            Alert::error(trans('admin.delete'), trans('s_admin.not_deleted_used'));
        }else{
            $deleted = Plan_revision::where('id',$id)->delete();
            if($deleted != null){
                Alert::success(trans('admin.delete'), trans('s_admin.deleted_s'));
            }else{
                Alert::error(trans('admin.delete'), trans('s_admin.not_deleted'));
            }
        }
        return back();
    }
    public function edit($id,$type)
    {
        if($type == 'new'){
            $data =  Plan_new::find($id);
        }else if($type == 'tracomy'){
            $data =  Plan_tracomy::find($id);
        }else if($type == 'revision'){
            $data =  Plan_revision::find($id);
        }

        $from_Surah_aya_num = $data->From_Surah->ayat_num +1;
        for($i = 1; $i < $from_Surah_aya_num ; $i++){
            $from_numbers[$i] = $i;
        }

        $to_Surah_aya_num = $data->To_Surah->ayat_num +1;
        for($i = 1; $i < $to_Surah_aya_num ; $i++){
            $to_numbers[$i] = $i;
        }
        return view('admin.episodes.levels.subjects.subject_levels.daily_plan.edit',compact('data','from_numbers','to_numbers','type'));
    }

    public function update(Request $request)
    {
        if($request->from_surah_id > $request->to_surah_id){
            Alert::warning(trans('s_admin.update'), trans('s_admin.dont_updated_becase_of_sorting_sura'));
            return back();
        }
        if($request->from_surah_id == $request->to_surah_id){
            if($request->from_num > $request->to_num){
                Alert::warning(trans('s_admin.update'), trans('s_admin.dont_updated_becase_of_sorting_aya_sura'));
                return back();
            }
        }
        $input['from_surah_id'] = $request->from_surah_id;
        $input['to_surah_id'] = $request->to_surah_id;
        $input['from_num'] = $request->from_num;
        $input['to_num'] = $request->to_num;
        if($request->type == 'new'){
            Plan_new::where('id',$request->id)->update($input);
        }else if($request->type == 'tracomy'){
            Plan_tracomy::where('id',$request->id)->update($input);
        }else if($request->type == 'revision'){
            Plan_revision::where('id',$request->id)->update($input);
        }
        Alert::success(trans('s_admin.update'), trans('s_admin.updted_s'));
        return redirect(route('subject_levels_daily_plan.show',$request->sub_level_id));
    }
    public function destroy($id)
    {
        //
    }
}
