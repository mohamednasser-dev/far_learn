<?php

namespace App\Listeners;

use App\Events\NotificationEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotificationListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(NotificationEvent $event)
    {
        $notification = $event->notification ;
        if($notification->type == 'student'){
            $receiver = $notification->Student ;
        }else{
            $receiver = $notification->Teacher ;
        }
        if($receiver){
            send( $receiver->fcm_token ,$notification->title ,$notification->message  ,$notification->message_type  , $notification->inbox_id);

        }

    }
}
