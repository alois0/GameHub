<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;


class OrderConfirmedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
{
    Log::info('📧 Envoi de l’email de confirmation avec la vue mail.order_confirmation');

    return (new \Illuminate\Notifications\Messages\MailMessage)
        ->subject('🛒 Confirmation de votre commande - GameHub')
        ->markdown('mail.order_confirmation', [ // 🔥 UTILISER `markdown()` ICI !
            'order' => $this->order,
            'user' => $notifiable
        ]);
}

    


    

}
