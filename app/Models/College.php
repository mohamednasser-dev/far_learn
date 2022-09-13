<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    protected $fillable = [
        'name_ar', 'name_en','type','mosque_name','mogmaa_time','mogmaa_type','study_days','study_period','episode_form',
        'location_lang','teacher_id','range','location_lat'
    ];


    public function Mogmaat()
    {
        return $this->hasMany('App\Models\Episode','college_id', 'id')->where('deleted','0');
    }
}
