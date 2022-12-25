<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubjectEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'=>'required|exists:subjects,id',
            'name_ar'=>'required',
            'name_en'=>'required',
            'amount_num'=>'required|numeric',
            'class_amount'=>'required|numeric',
            'from_surah_id'=>'required|exists:plan_surahs,id',
            'from_num'=>'required',
            'to_surah_id'=>'required|exists:plan_surahs,id',
            'to_num'=>'required',
        ];
    }
}
