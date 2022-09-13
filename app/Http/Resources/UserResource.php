<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            "id" => $this->id,
            "user_name" => $this->user_name,
            "image" => $this->image,
            "type" => $this->type,
            "is_new" => $this->is_new,
            "status" => $this->status,
        ];
    }
}
