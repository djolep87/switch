<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AcceptNotifications extends Notification
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
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
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
                    ->greeting('Zdravo!')
                    ->subject('Obaveštenje o prihvaćeom zahtevu')
                    ->line('Vaš zahtev je prihvaćen. Kontaktirajte korisnika radi uspešne razmene.')
                    ->action('Pogledajte ponudu', url('/sendOffers'))
                    ->line('Hvala što koristite našu aplikaciju!')
                    ->salutation("Pozdrav,\n\n**" . config('app.name') . "**");
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
            'data' => 'Vaš zahtev je prihvaćen!',
            'url' => url('/sendOffers'), 
        ];
    }
}
