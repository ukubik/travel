<?php

namespace App\Listeners;

use App\User;
use App\Events\NewCommentArticle;
use App\Notifications\NewCommentAdded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class NewCommentAddedNotififcation
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
     * @param  NewCommentArticle  $event
     * @return void
     */
    public function handle(NewCommentArticle $event)
    {
      $users = User::whereRoleId(1)->get();
      Notification::send($users, new NewCommentAdded($event->comment));
    }
}
