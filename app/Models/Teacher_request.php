<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher_request extends Model
{
    protected $guarded = [''];

    public function Teacher(){
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
}
