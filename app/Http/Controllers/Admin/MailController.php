<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin_notification;
use App\Models\Episode;
use App\Models\Inbox;
use App\Models\Notification;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class MailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function incoming()
    {
        $data = Teacher::where('is_new', 'y')->orderBy('id', 'asc')->get();
        return view('admin.web_settings.teachers.teachers_settings', compact('data'));
    }

    public function inbox()
    {
        $data = Admin_notification::where('message_type', 'long_episode')->orderBy('created_at', 'desc')->get();
        $data_come = Admin_notification::where('message_type', 'inbox')->orderBy('created_at', 'desc')->get();
//        $new_Data['readed'] = '1';
//        Admin_notification::where('message_type','long_episode')->where('readed','0')->orderBy('created_at','desc')->update($new_Data);
        return view('admin.Mails.index', compact('data', 'data_come'));
    }

    public function MailInbox()
    {
        $data = Inbox::where('receiver_id', Auth::user()->id)->where('receiver_type', 'admin')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.Mails.index', compact('data'));
    }

    public function MailOutbox()
    {
        $data = Inbox::where('sender_id', Auth::user()->id)->where('sender_type', 'admin')->orderBy('id', 'desc')->paginate(10);
        return view('admin.Mails.index', compact('data'));
    }

    public function MailReply($id)
    {
        $data = Inbox::whereId($id)->with('childreninboxes')->firstOrFail();
        if ($data->inbox_id != null) {
            $data = Inbox::whereId($data->inbox_id)->with('childreninboxes')->firstOrFail();
        }

        Admin_notification::where('inbox_id', $id)->update([
            'readed' => 1
        ]);
        return view('admin.Mails.index', compact('data'));
    }


    public function SendInbox(Request $request)
    {
        $data = $this->validate(\request(),
            [

                'subject' => 'required',
                'message' => 'required',
                'receiver_id' => 'required',

            ]);
        $receiver = explode(',', $request->receiver_id);
        $data['sender_id'] = Auth::user()->id;
        $data['sender_type'] = "admin";
//        if here
        if ($request->receiver_id == "all_teacher") {
            $data['receiver_type'] = "teacher";
            $data['receiver_id'] = null;
            $data['type'] = "all_teachers";
        } else if ($request->receiver_id == "all_student") {
            $data['receiver_type'] = "student";
            $data['receiver_id'] = null;
            $data['type'] = "all_students";
        } else {
            $data['receiver_type'] = $receiver[0];
            $data['receiver_id'] = $int = (int)$receiver[1];
        }


        $data = Inbox::create($data);


        if ($request->receiver_id == "all_teacher") {
            foreach (Teacher::all() as $teacher) {
                $notification['title_ar'] = $data->subject;
                $notification['title_en'] = $data->subject;
                $notification['message_ar'] = $data->message;
                $notification['message_en'] = $data->message;
                $notification['message_type'] = "inbox";
                $notification['type'] = "teacher";
                $notification['inbox_id'] = $data->id;
                if ($data->receiver_type == "admin") {
                    Admin_notification::create($notification);
                } elseif ($data->receiver_type == "teacher") {
                    $notification['type'] = "teacher";
                    $notification['teacher_id'] = $teacher->id;
                    Notification::create($notification);
                } else {
                    $notification['type'] = "student";
                    $notification['student_id'] = $receiver;
                    Notification::create($notification);
                }
            }
        } elseif ($request->receiver_id == "all_student") {

            foreach (Student::all() as $teacher) {
                $notification['title_ar'] = $data->subject;
                $notification['title_en'] = $data->subject;
                $notification['message_ar'] = $data->message;
                $notification['message_en'] = $data->message;
                $notification['message_type'] = "inbox";
                $notification['type'] = "teacher";
                $notification['inbox_id'] = $data->id;
                if ($data->receiver_type == "admin") {
                    Admin_notification::create($notification);
                } elseif ($data->receiver_type == "teacher") {
                    $notification['type'] = "teacher";
                    $notification['teacher_id'] = $teacher->id;
                    Notification::create($notification);
                } else {
                    $notification['type'] = "student";
                    $notification['student_id'] = $teacher->id;
                    Notification::create($notification);
                }
            }
        } else {
            $notification['title_ar'] = $data->subject;
            $notification['title_en'] = $data->subject;
            $notification['message_ar'] = $data->message;
            $notification['message_en'] = $data->message;
            $notification['message_type'] = "inbox";
            $notification['type'] = "student";
            $notification['inbox_id'] = $data->id;
            if ($data->receiver_type == "admin") {
                Admin_notification::create($notification);
            } elseif ($data->receiver_type == "teacher") {
                $notification['type'] = "teacher";
                $notification['teacher_id'] = $data->receiver_id;
                Notification::create($notification);
            } else {
                $notification['type'] = "student";
                $notification['student_id'] = $data->receiver_id;
                Notification::create($notification);
            }
        }
        Alert::success(trans('admin.email_sent'), trans('admin.Sent_success'));

        return redirect()->back();
    }

    public function SendReply(Request $request)
    {

        $data = $this->validate(\request(),
            [
                'subject' => 'required',
                'message' => 'required',
                'inbox_id' => 'required|exists:inboxes,id',

            ]);
        $parent = Inbox::findOrFail($request->inbox_id);
        if ($parent->sender_id == Auth::id()) {
            $receiver = $parent->receiver_id;
            $receiver_type = $parent->receiver_type;
        } else {
            $receiver = $parent->sender_id;
            $receiver_type = $parent->sender_type;
        }

        if ($parent->type == "all_teachers") {
            $receiver = null;
            $data['type'] = "all_teachers";

        } else if ($parent->type == "all_students") {
            $receiver = null;
            $data['type'] = "all_students";

        }

        $data['sender_id'] = Auth::user()->id;
        $data['sender_type'] = "admin";
        $data['receiver_type'] = $receiver_type;
        $data['receiver_id'] = $receiver;
        $data['inbox_id'] = $int = (int)$request->inbox_id;
        $data = Inbox::create($data);

        if ($data->type == "all_teachers") {
            foreach (Teacher::all() as $teacher) {
                $notification['title_ar'] = $data->subject;
                $notification['title_en'] = $data->subject;
                $notification['message_ar'] = $data->message;
                $notification['message_en'] = $data->message;
                $notification['message_type'] = "inbox";
                $notification['type'] = "teacher";
                $notification['inbox_id'] = $data->id;
                if ($data->receiver_type == "admin") {
                    Admin_notification::create($notification);
                } elseif ($data->receiver_type == "teacher") {
                    $notification['type'] = "teacher";
                    $notification['teacher_id'] = $teacher->id;
                    Notification::create($notification);
                } else {
                    $notification['type'] = "student";
                    $notification['student_id'] = $receiver;
                    Notification::create($notification);
                }
            }
        } elseif ($data->type == "all_students") {

            foreach (Student::all() as $teacher) {
                $notification['title_ar'] = $data->subject;
                $notification['title_en'] = $data->subject;
                $notification['message_ar'] = $data->message;
                $notification['message_en'] = $data->message;
                $notification['message_type'] = "inbox";
                $notification['type'] = "teacher";
                $notification['inbox_id'] = $data->id;
                if ($data->receiver_type == "admin") {
                    Admin_notification::create($notification);
                } elseif ($data->receiver_type == "teacher") {
                    $notification['type'] = "teacher";
                    $notification['teacher_id'] = $teacher->id;
                    Notification::create($notification);
                } else {
                    $notification['type'] = "student";
                    $notification['student_id'] = $teacher->id;
                    Notification::create($notification);
                }
            }
        } else {
            $notification['title_ar'] = $data->subject;
            $notification['title_en'] = $data->subject;
            $notification['message_ar'] = $data->message;
            $notification['message_en'] = $data->message;
            $notification['message_type'] = "inbox";
            $notification['type'] = "student";
            $notification['inbox_id'] = $data->id;
            if ($data->receiver_type == "admin") {
                Admin_notification::create($notification);
            } elseif ($data->receiver_type == "teacher") {
                $notification['type'] = "teacher";
                $notification['teacher_id'] = $receiver;
                Notification::create($notification);
            } else {
                $notification['type'] = "student";
                $notification['student_id'] = $receiver;
                Notification::create($notification);
            }
        }

        Alert::success(trans('admin.email_sent'), trans('admin.Sent_success'));

        return redirect()->back();
    }

    public function long_episodes()
    {
        $user = \auth()->user();
        if ($user->role_id == 3 || $user->role_id == 9 || $user->role_id == 10 || $user->role_id == 11) {
            $episode_ids = Episode::where('college_id', $user->college_id)->where('active', 'y')->where('type', 'mogmaa')->pluck('id')->toArray();
            $data = Admin_notification::whereIn('episode_id', $episode_ids)->where('status', 'new')->where('message_type', 'long_episode')->orderBy('created_at', 'desc')->get();
            $accepted_data = Admin_notification::whereIn('episode_id', $episode_ids)->where('status', 'accepted')->where('message_type', 'long_episode')->orderBy('created_at', 'desc')->get();
            $rejected_data = Admin_notification::whereIn('episode_id', $episode_ids)->where('status', 'rejected')->where('message_type', 'long_episode')->orderBy('created_at', 'desc')->get();
            $new_Data['readed'] = '1';
            Admin_notification::whereIn('episode_id', $episode_ids)->where('message_type', 'long_episode')->where('readed', '0')->orderBy('created_at', 'desc')->update($new_Data);
        } elseif ($user->role_id == 5 || $user->role_id == 12 || $user->role_id == 13 || $user->role_id == 14) {
            $episode_ids = Episode::where('college_id', $user->college_id)->where('active', 'y')->where('type', 'dorr')->pluck('id')->toArray();
            $data = Admin_notification::whereIn('episode_id', $episode_ids)->where('status', 'new')->where('message_type', 'long_episode')->orderBy('created_at', 'desc')->get();
            $accepted_data = Admin_notification::whereIn('episode_id', $episode_ids)->where('status', 'accepted')->where('message_type', 'long_episode')->orderBy('created_at', 'desc')->get();
            $rejected_data = Admin_notification::whereIn('episode_id', $episode_ids)->where('status', 'rejected')->where('message_type', 'long_episode')->orderBy('created_at', 'desc')->get();
            $new_Data['readed'] = '1';
            Admin_notification::whereIn('episode_id', $episode_ids)->where('message_type', 'long_episode')->where('readed', '0')->orderBy('created_at', 'desc')->update($new_Data);
        } elseif ($user->role_id == 8) {
            $episode_ids = Episode::where('gender', $user->gender)->where('active', 'y')->where('type', 'mqraa')->pluck('id')->toArray();
            $data = Admin_notification::whereIn('episode_id', $episode_ids)->where('status', 'new')->where('message_type', 'long_episode')->orderBy('created_at', 'desc')->get();
            $accepted_data = Admin_notification::whereIn('episode_id', $episode_ids)->where('status', 'accepted')->where('message_type', 'long_episode')->orderBy('created_at', 'desc')->get();
            $rejected_data = Admin_notification::whereIn('episode_id', $episode_ids)->where('status', 'rejected')->where('message_type', 'long_episode')->orderBy('created_at', 'desc')->get();
            $new_Data['readed'] = '1';
            Admin_notification::whereIn('episode_id', $episode_ids)->where('message_type', 'long_episode')->where('readed', '0')->orderBy('created_at', 'desc')->update($new_Data);
        } else {
            $data = Admin_notification::where('status', 'new')->where('message_type', 'long_episode')->orderBy('created_at', 'desc')->get();
            $accepted_data = Admin_notification::where('status', 'accepted')->where('message_type', 'long_episode')->orderBy('created_at', 'desc')->get();
            $rejected_data = Admin_notification::where('status', 'rejected')->where('message_type', 'long_episode')->orderBy('created_at', 'desc')->get();
            $new_Data['readed'] = '1';
            Admin_notification::where('message_type', 'long_episode')->where('readed', '0')->orderBy('created_at', 'desc')->update($new_Data);
        }
        return view('admin.episodes.long_episodes.index', compact('data', 'accepted_data', 'rejected_data'));
    }

    public function change_status_long_episodes($id, $status)
    {
        $data = \App\Models\Admin_notification::find($id);
        $data->status = $status;
        $data->save();
        $epo_request=    Episode::where('id', $data->episode_id)->first();

        if($status == 'accepted'){
            $input_student['teacher_id'] = $data->teacher_id;
            $input_student['type'] = 'teacher';
            $input_student['message_type'] = 'long_episode';
            $input_student['title_ar'] = 'تم الموافقة على تمديد الحلقة ';
            $input_student['title_en'] = 'Episode extension approved';
            $input_student['message_ar'] = 'تم الموافقة على تمديد حلقة   ' . $epo_request->name_ar;
            $input_student['message_en'] = 'Episode  - ' . $epo_request->name_en . '- extension approved';
            $notification = Notification::create($input_student);

        }else{
            $input_student['teacher_id'] = $data->teacher_id;
            $input_student['type'] = 'teacher';
            $input_student['message_type'] = 'long_episode';
            $input_student['message_type'] = 'long_episode';
            $input_student['title_ar'] = 'تم رفض على تمديد الحلقة ';
            $input_student['title_en'] = 'Episode extension rejected';
            $input_student['message_ar'] = 'تم الموافقة على تمديد حلقة   ' . $epo_request->name_ar;
            $input_student['message_en'] = 'Episode  - ' . $epo_request->name_en . '- extension rejected';
            $notification = Notification::create($input_student);

        }

        Alert::success(trans('s_admin.edit_epo_time'), trans('s_admin.change_episode_s'));
        return back();
    }
}
