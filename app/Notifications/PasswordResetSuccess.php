<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PasswordResetSuccess extends Notification
{
    use Queueable;
    
    /**
    * Create a new notification instance.
    *
    * @return void
    */
    public function __construct()
    {
        //
    }

    /**
    * Get the notification's delivery channels.
    *
    * @return array
    */
    public function via()
    {
        return ['mail'];
    }

    /**
    * Get the mail representation of the notification.
    *
    * @param mixed $notifiable notifiable
    *
    * @return \Illuminate\Notifications\Messages\MailMessage
    */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line(trans('login.mail.notice_success'))
            ->line(trans('login.mail.remind_protect'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable notifiable
     *
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
