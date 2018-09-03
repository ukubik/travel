<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
        'App\Events\GuestMessage' => [
          'App\Listeners\GuestMessageNotification',
        ],
        'App\Events\NewArticle' => [
          'App\Listeners\NewArticleCreatedNotification',
        ],
        'App\Events\NewCommentArticle' => [
          'App\Listeners\NewCommentAddedNotififcation',
        ],
        'App\Events\ClaimNewAuthor' => [
          'App\Listeners\ClaimNewAuthorNotification'
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
