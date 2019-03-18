<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PasswordResetRequest extends Notification
{
    use Queueable;

    protected $token;

    /**
    * Create a new notification instance.
    *
    * @param string $token token
    *
    * @return void
    */
    public function __construct($token)
    {
        $this->token = $token;
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
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail()
    {
        $url = url('password/reset/'.$this->token);
        return (new MailMessage)
          ->line(trans('login.mail.notice_request'))
          ->action(trans('login.reset_password'), url($url))
          ->line(trans('login.mail.remind_change'));
    }
}
