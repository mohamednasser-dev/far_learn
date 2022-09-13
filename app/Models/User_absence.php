<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_absence extends Model
{
    protected $fillable = [
        'user_id','absence_date','type'
    ];

    public function User(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
