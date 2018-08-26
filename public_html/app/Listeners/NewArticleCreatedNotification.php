<?php

namespace App\Listeners;

use App\User;
use App\Events\NewArticle;
use App\Notifications\NewArticleCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class NewArticleCreatedNotification
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
     * @param  NewArticle  $event
     * @return void
     */
    public function handle(NewArticle $event)
    {
        $users = User::whereSubscription('Подписан')->get();
        Notification::send($users, new NewArticleCreated($event->article));
    }
}
