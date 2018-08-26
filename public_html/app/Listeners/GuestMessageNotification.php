<?php

namespace App\Listeners;

use App\User;
use App\Events\GuestMessage;
use App\Notifications\NewGuetMessage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class GuestMessageNotification
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
     * @param  GuestMessage  $event
     * @return void
     */
    public function handle(GuestMessage $event)
    {
        $users = User::whereRoleId(1)->get();
        Notification::send($users, new NewGuetMessage($event->message));
    }
}
