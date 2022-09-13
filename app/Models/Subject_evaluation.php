<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject_evaluation extends Model
{
    protected $fillable = [
        'subject_id', 'type','amount_tracomy','highest_rate','excellent','very_good','good','not_pathing'
    ];
    public function Subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}
