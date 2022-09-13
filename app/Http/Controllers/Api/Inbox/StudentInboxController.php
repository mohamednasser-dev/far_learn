<?php

namespace App\Http\Controllers\Api\Inbox;

use App\Http\Resources\InboxResources;
use App\Http\Controllers\Controller;
use App\Models\Admin_notification;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\Inbox;
use App\Models\User;
use Validator;

class StudentInboxController extends Controller
{
    public function MailInbox(Request $request)
    {
        $user = check_api_token($request->header('apitoken'));
        if ($user) {
            if ($user->type == "student") {
                $data = Inbox::where(function ($q) use ($user) {
                    $q->where('receiver_id', $user->id)->where('receiver_type', 'student');
                })->orwhere('type', 'all_students')->orderBy('created_at', 'desc')->paginate(10);

            } else {
                $data = Inbox::where(function ($q) use ($user) {
                    $q->where('receiver_id', $user->id)->where('receiver_type', 'teacher');
                })->orwhere('type', 'all_teachers')
                    ->orderBy('created_at', 'desc')->paginate(10);
            }

            $data = InboxResources::collection($data)->response()->getData(true);
            return msgdata($request, success(), trans('s_admin.shown_s'), $data);
        } else {
            return msgdata($request, not_authoize(), trans('s_admin.not_authorize'), (object)[]);

        }
    }

    public function MailOutbox(Request $request)
    {
        $user = check_api_token($request->header('apitoken'));
        if ($user) {
            if ($user->type == "student") {
                $data = Inbox::where('sender_id', $user->id)
                    ->where('sender_type', 'student')->orderBy('created_at', 'desc')->paginate(10);
            } else {
                $data = Inbox::where('sender_id', $user->id)
                    ->where('sender_type', 'teacher')->orderBy('created_at', 'desc')->paginate(10);
            }
            $data = InboxResources::collection($data)->response()->getData(true);
            return msgdata($request, success(), trans('s_admin.shown_s'), $data);

        } else {
            return msgdata($request, not_authoize(), trans('s_admin.not_authorize'), (object)[]);

        }
    }

    public function MailReply(Request $request, $id)
    {
        $user = check_api_token($request->header('apitoken'));
        if ($user) {
            if ($user->type == "student") {
                $data = Inbox::whereId($id)->with(['childreninboxes' => function ($q) use ($user) {
                    $q->where('type', 'all_students')->orWhere(function ($query) use ($user) {
                        $query->where('sender_id', $user->id)->where('sender_type', 'student');
                    })->orWhere(function ($query) use ($user) {
                        $query->where('receiver_id', $user->id)->where('receiver_type', 'student');
                    });
                }])->first();
                if ($data->inbox_id != null) {
                    $data = Inbox::whereId($data->inbox_id)->with(['childreninboxes' => function ($q) use ($user) {
                        $q->where('type', 'all_students')->orWhere(function ($query) use ($user) {
                            $query->where('sender_id', $user->id)->where('sender_type', 'student');
                        })->orWhere(function ($query) use ($user) {
                            $query->where('receiver_id', $user->id)->where('receiver_type', 'student');
                        });
                    }])->first();
                }

                Notification::where('inbox_id', $id)->update([
                    'readed' => 1
                ]);
            } else {
                $data = Inbox::whereId($id)->with(['childreninboxes' => function ($q) use ($user) {
                    $q->where('type', 'all_teachers')->orWhere(function ($query) use ($user) {
                        $query->where('sender_id', $user->id)->where('sender_type', 'teacher');
                    })->orWhere(function ($query) use ($user) {
                        $query->where('receiver_id', $user->id)->where('receiver_type', 'teacher');
                    });
                }])->first();
                if ($data->inbox_id != null) {
                    $data = Inbox::whereId($data->inbox_id)->with(['childreninboxes' => function ($q) use ($user) {
                        $q->where('type', 'all_teachers')->orWhere(function ($query) use ($user) {
                            $query->where('sender_id', $user->id)->where('sender_type', 'teacher');
                        })->orWhere(function ($query) use ($user) {
                            $query->where('receiver_id', $user->id)->where('receiver_type', 'teacher');
                        });
                    }])->first();
                }

                Notification::where('inbox_id', $id)->update([
                    'readed' => 1
                ]);
            }


            $response['parent_message'] = new InboxResources($data);
            $response['replies'] = InboxResources::collection($data->childreninboxes);
            return msgdata($request, success(), trans('s_admin.shown_s'), $response);
        }
        return msgdata($request, not_authoize(), trans('s_admin.not_authorize'), (object)[]);


    }

    public function SendInbox(Request $request)
    {
        $user = check_api_token($request->header('apitoken'));
        if ($user) {
            $rules = [
                'subject' => 'required',
                'message' => 'required',
                'receiver_id' => 'required',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json(msg($request, failed(), $validator->messages()->first()));
            }


            $data['sender_id'] = $user->id;
            $data['sender_type'] = $user->type;
            $data['receiver_type'] = "admin";
            $data['receiver_id'] = $request->receiver_id;
            $data['message'] = $request->message;
            $data['subject'] = $request->subject;

            $data = Inbox::create($data);
            $data = Inbox::whereId($data->id)->first();
            $notification['title_ar'] = $data->subject;
            $notification['title_en'] = $data->subject;
            $notification['message_ar'] = $data->message;
            $notification['message_en'] = $data->message;
            $notification['message_type'] = "inbox";
            $notification['type'] = "teacher";
            $notification['inbox_id'] = $data->id;
            if ($data->receiver_type == "admin") {
                Admin_notification::create($notification);
            }

            $data = new InboxResources(Inbox::find($data->id));
            return msgdata($request, success(), trans('s_admin.shown_s'), $data);

        }
        return msgdata($request, not_authoize(), trans('s_admin.not_authorize'), (object)[]);

    }

    public function SendReply(Request $request)
    {

        $user = check_api_token($request->header('apitoken'));
        if ($user) {
            if ($user->type == "teacher") {
                $rules = [
                    'subject' => 'required',
                    'message' => 'required',
                    'inbox_id' => 'required|exists:inboxes,id',
                ];

                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                    return response()->json(msg($request, failed(), $validator->messages()->first()));
                }

                $parent = Inbox::find($request->inbox_id);
                if ($parent->sender_id == $user->id) {
                    $receiver = $parent->receiver_id;
                    $receiver_type = $parent->receiver_type;
                } else {
                    $receiver = $parent->sender_id;
                    $receiver_type = $parent->sender_type;
                }
                $data['sender_id'] = $user->id;
                $data['sender_type'] = "teacher";
                $data['receiver_type'] = $receiver_type;
                $data['receiver_id'] = $receiver;
                $data['inbox_id'] = $request->inbox_id;
                $data['subject'] = $request->subject;
                $data['message'] = $request->message;
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
                }
                $data = new InboxResources(Inbox::find($data->id));
                return msgdata($request, success(), trans('s_admin.shown_s'), $data);
            } else {
                $rules = [
                    'subject' => 'required',
                    'message' => 'required',
                    'inbox_id' => 'required|exists:inboxes,id',
                ];

                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                    return response()->json(msg($request, failed(), $validator->messages()->first()));
                }

                $parent = Inbox::find($request->inbox_id);
                if ($parent->sender_id == $user->id) {
                    $receiver = $parent->receiver_id;
                    $receiver_type = $parent->receiver_type;
                } else {
                    $receiver = $parent->sender_id;
                    $receiver_type = $parent->sender_type;
                }
                $data['sender_id'] = $user->id;
                $data['sender_type'] = "student";
                $data['receiver_type'] = $receiver_type;
                $data['receiver_id'] = $receiver;
                $data['inbox_id'] = $request->inbox_id;
                $data['subject'] = $request->subject;
                $data['message'] = $request->message;
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
                }

                $data = new InboxResources(Inbox::find($data->id));
                return msgdata($request, success(), trans('s_admin.shown_s'), $data);
            }

        }
        return msgdata($request, not_authoize(), trans('s_admin.not_authorize'), (object)[]);


    }

    public function admins(Request $request)
    {
        $user = check_api_token($request->header('apitoken'));
        if ($user) {

            $data = User::where('status', 'active')->get();
            return msgdata($request, success(), trans('s_admin.shown_s'), $data);

        }
        return msgdata($request, not_authoize(), trans('s_admin.not_authorize'), []);

    }
}
