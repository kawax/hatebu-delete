<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DeleteNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @param  string  $title
     * @param  string  $url
     * @return void
     */
    public function __construct(
        protected string $title,
        protected string $url,
    ) {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via(mixed $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray(mixed $notifiable): array
    {
        return [
            'title' => $this->title,
            'url' => $this->url,
        ];
    }
}
