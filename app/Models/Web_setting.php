<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Web_setting extends Model
{
    protected $guarded = [];

    public function getLogoArAttribute($img){
        if ($img)
            return asset('/uploads/logo') . '/' . $img;
        else
            return "";
    }
    public function getLogoEnAttribute($img){
        if ($img)
            return asset('/uploads/logo') . '/' . $img;
        else
            return "";
    }
}
