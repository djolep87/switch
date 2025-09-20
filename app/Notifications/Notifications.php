<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Notifications extends Notification
{
    use Queueable;

    protected $offer;
    protected $sender;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($offer = null, $sender = null)
    {
        $this->offer = $offer;
        $this->sender = $sender;
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
        $senderName = $this->sender ? $this->sender->firstName . ' ' . $this->sender->lastName : 'Nepoznato';
        $productName = $this->offer && $this->offer->product ? $this->offer->product->title : 'Proizvod';
        $offerProductName = $this->offer && $this->offer->sendproduct ? $this->offer->sendproduct->title : 'Vaš proizvod';
        
        return [
            'type' => 'exchange_request',
            'title' => 'Novi zahtev za zamenu',
            'message' => "{$senderName} je poslao zahtev za zamenu: {$productName} za {$offerProductName}",
            'sender_name' => $senderName,
            'sender_id' => $this->sender ? $this->sender->id : null,
            'product_name' => $productName,
            'offer_product_name' => $offerProductName,
            'offer_id' => $this->offer ? $this->offer->id : null,
            'url' => url('/offers'),
            'icon' => 'bx bx-exchange',
            'color' => '#17a2b8',
            'timestamp' => now()->toISOString(),
        ];
    }
}
