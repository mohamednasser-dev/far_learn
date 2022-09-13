<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class AccountsResource extends JsonResource
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
            'name' => $this->name,
            'degree' => $this->degree,
            'record_number' => $this->record_number,
            'student_view' => $this->student_view,
            'episode' => $this->Episode ? $this->Episode->name : "--",
            'image' => $this->image,
            'pdf' => $this->pdf,
            'created_at' => Carbon::parse($this->created_at)->diffForHumans(),

        ];
    }


}
