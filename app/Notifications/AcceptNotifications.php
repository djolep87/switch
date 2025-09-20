<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AcceptNotifications extends Notification
{
    use Queueable;

    protected $offer;
    protected $acceptor;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($offer = null, $acceptor = null)
    {
        $this->offer = $offer;
        $this->acceptor = $acceptor;
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
                    ->subject('Obaveštenje o prihvaćenom zahtevu')
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
        $acceptorName = $this->acceptor ? $this->acceptor->firstName . ' ' . $this->acceptor->lastName : 'Nepoznato';
        $productName = $this->offer && $this->offer->product ? $this->offer->product->title : 'Proizvod';
        $offerProductName = $this->offer && $this->offer->sendproduct ? $this->offer->sendproduct->title : 'Vaš proizvod';
        
        return [
            'type' => 'exchange_accepted',
            'title' => 'Zahtev prihvaćen! 🎉',
            'message' => "{$acceptorName} je prihvatio vaš zahtev za zamenu: {$productName} za {$offerProductName}",
            'acceptor_name' => $acceptorName,
            'acceptor_id' => $this->acceptor ? $this->acceptor->id : null,
            'product_name' => $productName,
            'offer_product_name' => $offerProductName,
            'offer_id' => $this->offer ? $this->offer->id : null,
            'url' => url('/sendOffers'),
            'icon' => 'bx bx-check-circle',
            'color' => '#28a745',
            'timestamp' => now()->toISOString(),
        ];
    }
}
