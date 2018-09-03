<?php

namespace App\Listeners;

use App\User;
use App\Events\ClaimNewAuthor;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\NewClaimNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class ClaimNewAuthorNotification
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
     * @param  ClaimNewAuthor  $event
     * @return void
     */
    public function handle(ClaimNewAuthor $event)
    {
        $users = User::whereRoleId(1)->get();
        Notification::send($users, new NewClaimNotification($event->claim));
    }
}
