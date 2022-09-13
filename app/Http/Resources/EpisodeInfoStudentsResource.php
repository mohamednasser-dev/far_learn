<?php

namespace App\Http\Resources;

use App\Models\Plan_section_degree;
use App\Models\Student_Questions_episode;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class EpisodeInfoStudentsResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'student_id' => $this->student_id,
            'student_name' => $this->Student->user_name,
        ];
    }

}
