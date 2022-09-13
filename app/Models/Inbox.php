<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use stdClass;

class Inbox extends Model
{
    protected $fillable = [
        'message', 'subject', 'sender_id', 'receiver_id', 'sender_type',
        'receiver_type', 'inbox_id', 'type'
    ];

    public function getSenderApi()
    {
        if ($this->attributes['sender_type'] == "admin") {
            return User::where('id', $this->sender_id)->select('id', 'name', 'image')->first();
        } elseif ($this->attributes['sender_type'] == "teacher") {
            $teacher = Teacher::where('id', $this->sender_id)->first();
            $object = new stdClass;
            $object->id = $teacher->id;
            $object->name = $teacher->name;
            $object->image = $teacher->image;
            return $object;
        } else {
            $student = Student::where('id', $this->sender_id)->first();
            $object = new stdClass;
            $object->id = $student->id;
            $object->image =  $student->image;
            $object->name = $student->name;

            return $object;
        }
    }

    public function getRecieverApi()
    {
        if ($this->type == "all_teachers") {
            $object = new stdClass;
            $object->id = null;
            $object->name = trans("s_admin.all_teachers");
            $object->image = asset('/uploads/teachers/default.png');
            return $object;


        } elseif ($this->type == "all_students") {
            $object = new stdClass;
            $object->id = null;
            $object->name = trans("s_admin.all_students");
            $object->image = asset('/uploads/teachers/default.png');
            return $object;
        }
        if ($this->attributes['receiver_type'] == "admin") {
            return User::where('id', $this->receiver_id)->select('id', 'name', 'image')->first();
        } elseif ($this->attributes['receiver_type'] == "teacher") {
            $teacher = Teacher::where('id', $this->receiver_id)->first();
            $object = new stdClass;
            $object->id = $teacher->id;
            $object->name = $teacher->name;
            $object->image = $teacher->image;
            return $object;

        } else {
            $student = Student::where('id', $this->receiver_id)->first();
            $object = new stdClass;
            $object->id = $student->id;
            $object->name = $student->name;
             $object->image =  $student->image ;

            return $object;
        }
    }


    public function getSender()
    {
        if ($this->attributes['sender_type'] == "admin") {
            return $this->hasOne('App\Models\User', 'id', 'sender_id');
        } elseif ($this->attributes['sender_type'] == "teacher") {
            return $this->hasOne('App\Models\Teacher', 'id', 'sender_id');
        } else {
            return $this->hasOne('App\Models\Student', 'id', 'sender_id');
        }
    }


    public function getReciever()
    {

        if ($this->attributes['receiver_type'] == "admin") {
            return $this->hasOne('App\Models\User', 'id', 'receiver_id');
        } elseif ($this->attributes['receiver_type'] == "teacher") {
            return $this->hasOne('App\Models\Teacher', 'id', 'receiver_id');
        } else {
            return $this->hasOne('App\Models\Student', 'id', 'receiver_id');

        }

    }

    public function inboxes()
    {
        return $this->hasOne(Inbox::class);
    }

    public function childreninboxes()
    {
        return $this->hasMany(Inbox::class)->with('inboxes')->orderBy('id', 'asc');
    }
    public function notification()
    {
        return $this->hasOne(Notification::class ,'inbox_id');
    }


}
