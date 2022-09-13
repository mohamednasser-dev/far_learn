<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ErrorType extends Model
{
    protected $fillable = [
        'name_ar','name_en','start_hasm','hasm_degree','deleted'
    ];
}
