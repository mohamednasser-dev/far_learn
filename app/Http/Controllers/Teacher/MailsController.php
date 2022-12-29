<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Admin_notification;
use App\Models\Episode;
use App\Models\Episode_request;
use App\Models\Inbox;
use App\Models\Notification;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Exception;

class MailsController extends Controller
{

    public function inbox()
    {
//        , compact('data','data_come')
        return view('teacher.Mails.index');
    }


    public function MailInbox()
    {
        $data = Inbox::where(function ($q) {
            $q->where('receiver_id', Auth::guard('teacher')->user()->id)->where('receiver_type', 'teacher');
        })->orwhere('type', 'all_teachers')
            ->orderBy('created_at', 'desc')->get();
        return view('teacher.Mails.index', compact('data'));
    }

    public function MailOutbox()
    {
        $data = Inbox::where('sender_id', Auth::guard('teacher')->user()->id)
            ->where('sender_type', 'teacher')->orderBy('created_at', 'desc')->get();
        return view('teacher.Mails.index', compact('data'));
    }

    public function MailReply($id)
    {
//        ->with(['childreninboxes' => function ($q) {
//        $q->where('type', 'all_teachers')->orWhere(function ($query) {
//            $query->where('sender_id', Auth::guard('teacher')->user()->id)->where('sender_type', 'teacher');
//        });
//    }])
        $data = Inbox::whereId($id)->with('childreninboxes')->firstOrFail();
        if ($data->inbox_id != null) {
            $data = Inbox::whereId($data->inbox_id)->with('childreninboxes')->firstOrFail();
        }

        Notification::where('inbox_id', $id)->update([
            'readed' => 1
        ]);

        return view('teacher.Mails.index', compact('data'));
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
        if ($parent->sender_id == Auth::guard('teacher')->id()) {
            $receiver = $parent->receiver_id;
            $receiver_type = $parent->receiver_type;
        } else {
            $receiver = $parent->sender_id;
            $receiver_type = $parent->sender_type;
        }

//        if ($parent->type == "all_teachers"){
//            $receiver = null;
//            $data['type'] = "all_teachers";
//
//        }else if ($parent->type == "all_teachers"){
//            $receiver = null;
//            $data['type'] = "all_student";
//
//        }

        $data['sender_id'] = Auth::guard('teacher')->id();
        $data['sender_type'] = "teacher";
        $data['receiver_type'] = $receiver_type;
        $data['receiver_id'] = $receiver;
        $data['inbox_id'] = $int = (int)$request->inbox_id;


        $data = Inbox::create($data);

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
            $notification['teacher_id'] = $data->receiver_id;
            Notification::create($notification);
        } else {
            $notification['type'] = "student";
            $notification['student_id'] = $data->receiver_id;
            Notification::create($notification);
        }
        Alert::success(trans('admin.email_sent'), trans('admin.Sent_success'));

        return redirect()->back();
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
        $data['sender_id'] = Auth::guard('teacher')->user()->id;
        $data['sender_type'] = "teacher";
        $data['receiver_type'] = $receiver[0];
        $data['receiver_id'] = $int = (int)$receiver[1];
        $data = Inbox::create($data);

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
            $notification['teacher_id'] = $data->receiver_id;
            Notification::create($notification);
        } else {
            $notification['type'] = "student";
            $notification['student_id'] = $data->receiver_id;
            Notification::create($notification);
        }
        Alert::success(trans('admin.email_sent'), trans('admin.Sent_success'));

        return redirect()->back();
    }

}
