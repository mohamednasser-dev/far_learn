<?php

namespace App\Http\Controllers\Api\Students;

use App\Http\Resources\NotificationsResources;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Validator;

class NotificationController extends Controller
{
    public function unreaded_count(Request $request)
    {
        $user = check_api_token($request->header('apitoken'));
        if ($user && $user->type == 'student') {
            $unread_notifications = Notification::where('student_id', $user->id)->where('readed', '0')->count();
            return msgdata($request, success(), trans('s_admin.shown_s'), $unread_notifications);
        }elseif ($user && $user->type == 'teacher') {
            $unread_notifications = Notification::where('teacher_id', $user->id)->where('readed', '0')->count();
            return msgdata($request, success(), trans('s_admin.shown_s'), $unread_notifications);
        } else {
            return msgdata($request, not_authoize(), trans('s_admin.not_authorize'), (object)[]);
        }
    }

    public function Notification(Request $request)
    {
        $user = check_api_token($request->header('apitoken'));
        if ($user) {
            if ($user->type == 'student') {
                $notification = Notification::where('student_id', $user->id)->orderBy('id', 'desc')->paginate(10);
            } elseif ($user->type == 'teacher') {
                $notification = Notification::where('teacher_id', $user->id)->orderBy('id', 'desc')->paginate(10);
            } else {
                return msgdata($request, not_authoize(), trans('s_admin.not_authorize'), (object)[]);
            }
            $data = NotificationsResources::collection($notification)->response()->getData(true);
            return msgdata($request, success(), trans('s_admin.shown_s'), $data);
//            if(count($notification) > 0){
//            }else{
//                return msgdata($request, failed(), trans('s_admin.no_notification_s'), (object)[]);
//            }
        } else {
            return msgdata($request, not_authoize(), trans('s_admin.not_authorize'), (object)[]);

        }
    }

    public function NotificationDetails(Request $request, $id)
    {
        $user = check_api_token($request->header('apitoken'));
        if ($user) {
            $notification = Notification::find($id);
            $notification->readed = "1";
            $notification->save();

            if ($notification) {
                $data = new NotificationsResources($notification);

            } else {
                return msgdata($request, not_found(), trans('admin.not_found'), (object)[]);

            }
            return msgdata($request, success(), trans('s_admin.shown_s'), $data);

        } else {
            return msgdata($request, not_authoize(), trans('s_admin.not_authorize'), (object)[]);

        }

    }

    public function make_read(Request $request, $id)
    {
        $user = check_api_token($request->header('apitoken'));
        if ($user) {
            $notification = Notification::find($id);
            if ($notification) {
                $notification->readed = "1";
                $notification->save();
                return msgdata($request, success(), trans('s_admin.notification_seen_s'), (object)[]);
            } else {
                return msgdata($request, not_found(), trans('admin.not_found'), (object)[]);
            }
        } else {
            return msgdata($request, not_authoize(), trans('s_admin.not_authorize'), (object)[]);
        }
    }

}

