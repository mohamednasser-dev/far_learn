<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sms_message extends Model
{
    protected $fillable = [
        'message', 'receiver_type','receiver_id','message_id'
    ];
}
