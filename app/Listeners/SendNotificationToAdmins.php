<?php

namespace App\Listeners;

use App\Events\NewUserCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
class SendNotificationToAdmins
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewUserCreated $event): void
    {
        // Send notification to all admins
        logger('Sending notification to all admins');
        logger(json_encode($event->user));
       
    }
}
