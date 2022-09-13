<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student_parent extends Model
{
    protected $fillable = [
        'user_name', 'phone', 'home_phone','address','relation','student_id','parent_country_code','user_phone','password'
    ];

    public function Relation(){
        return $this->belongsTo(Relation::class, 'relation');
    }
}
