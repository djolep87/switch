<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Notifications extends Notification
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
                    ->subject('Obaveštenje o novom zahtevu za zamenu')
                    ->line('Imate novi zahtev za zamenu!')
                    ->action('Pogledajte ponudu', url('/offers'))
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
            'data' => 'Imate novi zahtev za zamenu',
            'url' => url('/offers'), // Ispravan URL za preusmeravanje
        ];
    }
}
