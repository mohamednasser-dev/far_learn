<?php

namespace App\Http\Resources;

use App\Models\Plan_section_degree;
use App\Models\Student_Questions_episode;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class EpisodeStudentsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    private static $section;

    public function toArray($request)
    {
        $absence = false;
        $my_turn = false;
        $degree = [] ;
        $Student_Questions_episode =  (object)[];
        if (self::$section) {
            $exist_absence = Plan_section_degree::where('student_id', $this->student_id)->where('section_id', self::$section->id)->where('type', 'absence')->first();
            if ($exist_absence) {
                $absence = true;
            }
            $mytime = \Carbon\Carbon::now();
            $today = \Carbon\Carbon::parse($mytime->toDateTimeString())->format('Y-m-d');
            $course_data = \App\Models\Episode_course_days::where('episode_id', $this->episode_id)->where('date', $today)->first();
            $Student_Questions_episode_db= Student_Questions_episode::where('episode_id', $this->episode_id)->where('student_id', $this->student_id)->where('episode_course_id', $course_data->id)->first();
            $Student_Questions_episode = $Student_Questions_episode_db ? (new StudentQuestionResource($Student_Questions_episode_db)) : (object)[] ;

            //student degree
            $student_degree_ask = Plan_section_degree::where('student_id', $this->student_id)->where('section_id', self::$section->id)->where('type', 'ask')->first();
            if ($student_degree_ask) {
                $degree[0]['id'] = (integer)$student_degree_ask->degree;
                $degree[0]['saved_lines'] = (integer)$student_degree_ask->saved_lines;
                $degree[0]['text'] = (string)$student_degree_ask->Ask_degree->name;
            }
            if(self::$section->order_num == $this->order_num){
                $my_turn = true;
            }
        }
        return [
            'id' => $this->id,
            'student_id' => $this->student_id,
            'student_name' => $this->Student->user_name,
            'order_num' => $this->order_num,
            'absence' => $absence,
            'my_turn' => $my_turn,
            'student_question' => $Student_Questions_episode,
            'degree' => $degree,
        ];
    }

    public static function customCollection($resource, $section): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        //you can add as many params as you want.
        self::$section = $section;
        return parent::collection($resource);
    }
}
