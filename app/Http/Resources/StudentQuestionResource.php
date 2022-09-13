<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentQuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'from_surah' => $this->From_Surah->name,
            'from_num' => $this->from_num,
            'to_surah' => $this->To_Surah->name,
            'to_num' => $this->to_num,

        ];
    }


}
