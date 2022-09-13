<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EpisodesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $complete_students = false;
        $students = 0;
        $students = count($this->Students) ;
        if($students == $this->student_number){
            $complete_students = true ;
        }else{
            $complete_students = false;
        }
        return [
            'data'=> $this->collection->map(function ($item){
                return[
                    "id"=> $this->id,
                    "title"=> $this->name,
                    "type"=> $this->type,
                    "time_from"=>$this->time_from,
                    "listen_type"=> $this->listen_type,
                    "student_number"=> $this->student_number,
                    "complete_students"=>$complete_students,
                    "episodes_students"=>$students,
                    "readings"=>$this->Readings,
                ];
            }),

            'links' => ResourcePaginationHelper::generateLinks($this, 'products.search')
        ];



    }
}
