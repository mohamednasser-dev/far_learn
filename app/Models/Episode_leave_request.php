<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Episode_leave_request extends Model
{
    protected $fillable = [
        'student_id', 'episode_id','status','admin_view'
    ];

    public function Episode()
    {
        return $this->belongsTo(Episode::class, 'episode_id');
    }

    public function Student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
