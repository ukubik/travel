<?php

namespace App\Notifications;

use App\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewArticleCreated extends Notification
{
    use Queueable;
    protected $article;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
      $url = url('/article/' . $this->article->id);
      return (new MailMessage)
                  ->subject('Новая статья')
                  ->line('На сайте добавлена новая статья: "' . $this->article->title . '".')
                  ->action('Читать', $url)
                  ->line('Спасибо что Вы с нами!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
