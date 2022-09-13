<?php

namespace App\Http\Controllers\Front;

use App\Models\Episode;
use App\Models\Subject_level;
use App\Models\Teacher;
use Spatie\Permission\Models\Model_has_role;
use Illuminate\Database\QueryException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use RealRashid\SweetAlert\Facades\Alert;

class EpisodesController extends Controller
{

    public function show($type)
    {
        if ($type == 'dorr' || $type == 'mogmaa') {
            $data = Episode::where('active', 'y')->whereHas('Teacher')->where('type', $type)->where('deleted', '0')->paginate(8);
        } else if ($type == 'all') {
            $data = Episode::where('active', 'y')->whereHas('Teacher')->where('deleted', '0')->paginate(8);
        } else {
            $data = Episode::where('active', 'y')->whereHas('Teacher')->where('type', 'mqraa')->where('gender', $type)->where('deleted', '0')->paginate(8);
        }
        $page_type = 'all';
        return view('front.episodes.index', compact('data', 'type','page_type'));
    }

    public function show_before_register($type,$page_type)
    {
        if ($type == 'dorr' || $type == 'mogmaa') {
            $data = Episode::where('active', 'y')->whereHas('Teacher')->where('type', $type)->where('deleted', '0')->paginate(8);
        }elseif($page_type == 'far_learn'){
            $data = Episode::where('active', 'y')->whereHas('Teacher')->where('type', 'mqraa')->where('deleted', '0')->paginate(8);
        } elseif ($type == 'all') {
            $data = Episode::where('active', 'y')->whereHas('Teacher')->where('deleted', '0')->paginate(8);
        } else {
            $data = Episode::where('active', 'y')->whereHas('Teacher')->where('type', 'mqraa')->where('gender', $type)->where('deleted', '0')->paginate(8);
        }
        $page_type = $page_type;
        return view('front.episodes.index', compact('data', 'type','page_type'));
    }

    public function search(Request $request, $type)
    {

        $page_type = $request->page_type;
        $type = $request->type;
        $result = Episode::query();
        $result = $result->where('active', 'y')->whereHas('Teacher')->where('deleted', '0');

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
        if ($request->language != null) {
            $teacher_ids = Teacher::Where('main_lang', $request->language )->pluck('id')->toArray();
            $result = $result->whereIn('teacher_id', $teacher_ids);
        }
        if ($request->epo_type) {
            if ($request->epo_type != 'on') {
                $result = $result->where('type', $request->epo_type);
            }
        }
        if($page_type == 'far_learn' || $request->type == 'male' || $request->type = 'female'  ||$request->type = 'children'){
            $result = $result->where('type','mqraa');
        }
        if ($request->gender) {
            if($request->gender != 'on'){
                $result = $result->where('gender', $request->gender);
            }
        }
        if ($request->level_id) {
            if($request->level_id != 'on'){
                if($request->level_id != 'all'){
                    $result = $result->where('level_id', $request->level_id);
                }
            }
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

        $data = $result->paginate(10);
        session()->flashInput($request->input());
        if ($data->count() == 0) {
            Alert::error(trans('s_admin.episodes'), trans('admin.no_data_found'));
        }
        return view('front.episodes.index', compact('data', 'type','page_type'));
    }

    public function get_subject_levels(Request $request, $id)
    {
        $data = Subject_level::where('subject_id', $id)->get();
        return view('front.login.parts.subject_levels', compact('data'));
    }

    public function teacher_details(Request $request, $id)
    {
        $data = Teacher::where('id', $id)->first();
        return view('front.episodes.teacher_details', compact('data'));
    }
}
