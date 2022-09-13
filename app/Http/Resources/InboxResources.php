<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class InboxResources extends JsonResource
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
            'message' => $this->message,
            'subject' => $this->subject,
            'sender_id' => $this->sender_id,
            'receiver_id' => $this->receiver_id,
            'sender_type' => $this->sender_type,
            'receiver_type' => $this->receiver_type,
            'created_at' => Carbon::parse($this->created_at)->diffForHumans(),
            'inbox_id' => $this->inbox_id,
            'type' => $this->type,
            'sender' => $this->getSenderApi(),
            'reciever' => $this->getRecieverApi(),
            'readed' => $this->notification ? $this->notification->readed : "1",
        ];
    }


}
