<?php

namespace App\Http\Controllers\Api\Students;

use App\Models\Student_level_history;
use App\Http\Controllers\Controller;
use Alkoumi\LaravelHijriDate\Hijri;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Teacher;
use Validator;

class profileController extends Controller
{
    public function profile(Request $request)
    {
        $user = check_api_token($request->header('apitoken'));
        if($user){
            if ($user->type == 'student') {
                if ($user->epo_type == 'far_learn' && $user->type == 'student') {
                    $user->level_name = $user->Level->name;
                }
                return msgdata($request, success(), trans('s_admin.shown_s'), $user);
            } elseif ($user->type == 'teacher') {
                return msgdata($request, success(), trans('s_admin.shown_s'), $user);

            }
         }else {
            return msgdata($request, not_authoize(), trans('s_admin.not_authorize'), (object)[]);
        }
    }

    public function check_type(Request $request)
    {
        $user = check_api_token($request->header('apitoken'));
        if ($user) {
            if($user->epo_type == 'far_learn' && $user->type == 'student'){
                $user->level_name = $user->Level->name ;
            }
            $data = array('type'=>$user->type);
            return msgdata($request, success(), trans('s_admin.shown_s'), $data);
        } else {
            return msgdata($request, not_authoize(), trans('s_admin.not_authorize'), (object)[]);
        }
    }

    public function update_profile(Request $request)
    {
        $user = check_api_token($request->header('apitoken'));
        if ($user) {

            if($user->type == 'teacher'){
                $input = $request->all();
                $rules = [
                    'first_name_ar' => 'required',
                    'mid_name_ar' => 'required',
                    'last_name_ar' => 'required',
                    'gender' => 'required',
                    'main_lang' => 'required',
                    'date_of_birth' => '',
                    'ident_num' => 'required',
                    'qualification' => 'required|exists:qualifications,id',
                    'country' => 'required',
                    'nationality' => 'required',
                    'i_pan' => 'nullable',
                    'save_quran_num' => 'nullable|numeric|max:30',
                    'image' => 'nullable',
                    'cv' => 'nullable',
                ];
            } else {
                $input = $request->all();
                $rules = [
                    'first_name_ar' => 'required',
                    'mid_name_ar' => 'required',
                    'last_name_ar' => 'required',
                    'gender' => 'required',
                    'main_lang' => 'required',
                    'date_of_birth' => '',
                    'ident_num' => 'required',
                    'qualification' => 'required|exists:qualifications,id',
                    'country' => 'required',
                    'nationality' => 'required',
                    'save_quran_num' => 'required|numeric|max:30',
                    'save_quran_limit' => 'required|exists:save_limits,id',
                    'level_id' => 'required|exists:levels,id',
                    'image' => 'nullable',
                    'subject_id' => 'nullable|exists:subjects,id',
                    'subject_level_id' => 'nullable|exists:subject_levels,id',
                ];
            }
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json(msg($request, failed(), $validator->messages()->first()));
            } else {
                if ($user->type == 'student') {
                    $student = Student::where('id', $user->id)->first();
                    $input['first_name_ar'] = $request->first_name_ar;
                    $input['mid_name_ar'] = $request->mid_name_ar;
                    $input['last_name_ar'] = $request->last_name_ar;

                    $input['first_name_en'] = $request->first_name_ar;
                    $input['mid_name_en'] = $request->mid_name_ar;
                    $input['last_name_en'] = $request->last_name_ar;

                    $input['user_name'] = $request->first_name_ar . " " . $request->mid_name_ar . " " . $request->last_name_ar;

                    $selected_date = $request->date_of_birth;
                    $year = \Carbon\Carbon::parse($selected_date)->format('Y');
                    if ($year < 1900) {
                        $year = \Carbon\Carbon::parse($selected_date)->format('Y');
                        $month = \Carbon\Carbon::parse($selected_date)->format('m');
                        $day = \Carbon\Carbon::parse($selected_date)->format('d');
                        $date = Hijri::DateToGregorianFromDMY($day, $month, $year);
                        $input['date_of_birth'] = $date;
                    } else {
                        $to_date = \Carbon\Carbon::parse($selected_date)->format('Y-m-d');
                        $input['date_of_birth'] = $to_date;
                    }

                    if ($request->image != null) {
                        $file = $request->file('image');
                        $name = $file->getClientOriginalName();
                        $ext = $file->getClientOriginalExtension();
                        // Move Image To Folder ..
                        $fileNewName = 'img_' . time() . '.' . $ext;
                        $file->move(public_path('uploads/students'), $fileNewName);
                        $input['image'] = $fileNewName;
                    }
                    unset($input['bio_ar']);
                    unset($input['bio_en']);
                    unset($input['i_pan']);
                    unset($input['cv']);
                    if ($student->epo_type != 'far_learn') {
                        if ($student->interview == 'y') {
                            unset($input['level_id']);
                            unset($input['subject_id']);
                            unset($input['subject_level_id']);
                        } else {
                            if ($request->level_id != null) {
                                $history_data['student_id'] = $user->id;
                                $history_data['level_id'] = $request->level_id;
                                $history_data['subject_id'] = $request->subject_id;
                                $history_data['subject_level_id'] = $request->subject_level_id;
                                $history_data['notes_ar'] = 'أول  منهج  للطالب بعد تسجيل الحساب';
                                $history_data['notes_en'] = 'The first course of the student after registering the account';
                                Student_level_history::create($history_data);
                            }
                        }
                    } else {
                        if ($request->level_id != null) {
                            $history_data['student_id'] = $user->id;
                            $history_data['level_id'] = $request->level_id;
                            $history_data['notes_ar'] = 'أول  منهج  للطالب بعد تسجيل الحساب';
                            $history_data['notes_en'] = 'The first course of the student after registering the account';
                            Student_level_history::create($history_data);
                        }
                    }
                    unset($input['gender']);
                    Student::where('id', $user->id)->update($input);
                    return response()->json(msg($request, success(), trans('s_admin.proileupdated_s')));
                } else {
                    unset($input['level_id']);
                    unset($input['subject_id']);
                    unset($input['subject_level_id']);
                    unset($input['save_quran_limit']);
                    $student = Teacher::where('id', $user->id)->first();
                    $input['first_name_ar'] = $request->first_name_ar;
                    $input['mid_name_ar'] = $request->mid_name_ar;
                    $input['last_name_ar'] = $request->last_name_ar;

                    $input['first_name_en'] = $request->first_name_ar;
                    $input['mid_name_en'] = $request->mid_name_ar;
                    $input['last_name_en'] = $request->last_name_ar;
                    $input['i_pan'] = $request->i_pan;
                    $input['bio_ar'] = $request->bio_ar;
                    $input['bio_en'] = $request->bio_en;

                    $input['user_name'] = $request->first_name_ar . " " . $request->mid_name_ar . " " . $request->last_name_ar;

                    $selected_date = $request->date_of_birth;
                    $year = \Carbon\Carbon::parse($selected_date)->format('Y');
                    if ($year < 1900) {
                        $year = \Carbon\Carbon::parse($selected_date)->format('Y');
                        $month = \Carbon\Carbon::parse($selected_date)->format('m');
                        $day = \Carbon\Carbon::parse($selected_date)->format('d');
                        $date = Hijri::DateToGregorianFromDMY($day, $month, $year);
                        $input['date_of_birth'] = $date;
                    } else {
                        $to_date = \Carbon\Carbon::parse($selected_date)->format('Y-m-d');
                        $input['date_of_birth'] = $to_date;
                    }

                    if ($request->image != null) {
                        $file = $request->file('image');
                        $name = $file->getClientOriginalName();
                        $ext = $file->getClientOriginalExtension();
                        // Move Image To Folder ..
                        $fileNewName = 'img_' . time() . '.' . $ext;
                        $file->move(public_path('uploads/teachers'), $fileNewName);
                        $input['image'] = $fileNewName;
                    }

                    if ($request->cv != null) {
                        $file = $request->file('cv');
                        $ext = $file->getClientOriginalExtension();
                        // Move Image To Folder ..
                        $fileNewName = 'cv_' . time() . '.' . $ext;
                        $file->move(public_path('uploads/teachers/cvs'), $fileNewName);
                        $input['cv'] = $fileNewName;
                    }

                    unset($input['gender']);
                    Teacher::where('id', $user->id)->update($input);
                    return response()->json(msg($request, success(), trans('s_admin.proileupdated_s')));
                }
            }
        } else {
            return msgdata($request, not_authoize(), trans('s_admin.not_authorize'), (object)[]);
        }
    }


    public function update_password(Request $request)
    {
        $user = check_api_token($request->header('apitoken'));
        if ($user) {
            $data = $request->all();
            $rules = [
                'password' => 'required|confirmed',
                'old_password' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json(msg($request, failed(), $validator->messages()->first()));
            } else {
                if ($user->type == 'teacher') {
                    $pass = Teacher::find($user->id)->password;
                    if (\Hash::check($request->old_password, $pass)) {
                        $data = Teacher::find($user->id);
                        $data->password = \Hash::make($request->password);
                        $data->save();
                        return response()->json(msg($request, success(), trans('s_admin.pass_changed')));
                    } else {
                        return response()->json(msg($request, failed(), trans('s_admin.current_pass_incorrect')));
                    }
                } else {
                    $pass = Student::find($user->id)->password;
                    if (\Hash::check($request->old_password, $pass)) {
                        $data = Student::find($user->id);
                        $data->password = \Hash::make($request->password);
                        $data->save();
                        return response()->json(msg($request, success(), trans('s_admin.pass_changed')));
                    } else {
                        return response()->json(msg($request, failed(), trans('s_admin.current_pass_incorrect')));
                    }
                }
            }
        } else {
            return msgdata($request, not_authoize(), trans('s_admin.not_authorize'), (object)[]);
        }
    }
}
