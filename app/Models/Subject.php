<?php

namespace App\Models;

use App\Models\Plan\Plan_surah;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'name_ar', 'name_en','desc_ar','desc_en','deleted','level_id','amount_num','class_amount' ,
        'from_surah_id' ,'from_num', 'to_surah_id', 'to_num'
    ];

    public function Level()
    {
        return $this->belongsTo(Level::class, 'level_id');
    }

    public function From_Surah()
    {
        return $this->belongsTo(Plan_surah::class, 'from_surah_id');
    }

    public function To_Surah()
    {
        return $this->belongsTo(Plan_surah::class, 'to_surah_id');
    }
}
