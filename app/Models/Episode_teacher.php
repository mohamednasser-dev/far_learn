<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Episode_teacher extends Model
{
    protected $fillable = [
        'episode_id','teacher_id'
    ];
    public function Episode()
    {
        return $this->belongsTo(Episode::class, 'episode_id')->where('deleted','0')->where('active','y');;
    }

    public function Student()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function Teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
}
