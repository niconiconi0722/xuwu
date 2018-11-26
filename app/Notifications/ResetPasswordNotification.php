<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends ResetPassword
{
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('重置密码')
            ->from('niconiconi@outlook.com', '万俟')
            ->view('emails.password', ['token' => $this->token])
            ->action('重置密码', url(config('app.url').route('password.reset', $this->token, false)));
    }
}
