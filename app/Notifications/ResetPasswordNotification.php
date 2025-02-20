<?php


namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordBase;

class ResetPasswordNotification extends ResetPasswordBase
{
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('🔒 Réinitialisation de votre mot de passe - GameHub')
            ->view('vendor.mail.reset', [
                'actionUrl' => url(route('password.reset', ['token' => $this->token, 'email' => $notifiable->email], false))
            ]);
    }
}