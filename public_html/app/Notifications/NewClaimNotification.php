<?php

namespace App\Notifications;

use App\ClaimAuthor;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewClaimNotification extends Notification
{
    use Queueable;
    protected $claim;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(ClaimAuthor $claim)
    {
        $this->claim = $claim;
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
        return (new MailMessage)
                    ->subject('Новая заявка')
                    ->line('Поступила новая заявка на авторство от ' . $this->claim->user->login . '.')
                    ->line('Тема статьи: ' . $this->claim->theme . '.')
                    ->line('Краткое содеожание: ' . $this->claim->description . '.')
                    ->action('Перейти к заявкам', url('/admin/claims'))
                    ->line('Необходимо удовлетворить или отклонить заявку!');
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
