<?php

namespace App\Notifications;

use App\GuestMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewGuetMessage extends Notification
{
    use Queueable;
    protected $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(GuestMessage $message)
    {
        $this->message = $message;
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
              ->subject('Новое сообщение')
              ->line('Гость <ins>' . $this->message->name . '</ins> оставил новое сообщение: ')
              ->line('<b>"' . $this->message->message . '"</b>')
              ->action('Перейти в админку', url('/admin/'))
              ->line('Спасибо, что Вы с нами!');
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
