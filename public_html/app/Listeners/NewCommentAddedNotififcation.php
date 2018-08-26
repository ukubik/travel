<?php

namespace App\Listeners;

use App\Events\NewCommentArticle;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
        //
    }
}
