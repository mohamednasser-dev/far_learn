<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationsResources extends JsonResource
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
            'title' => $this->title,
            'message' => $this->message,
            'message_type' => $this->message_type,
            'readed' => $this->readed,
            'inbox_id' => $this->inbox_id,
            'created_at' => Carbon::parse($this->created_at)->diffForHumans(),

        ];
    }


}
