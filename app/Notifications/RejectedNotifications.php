<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RejectedNotifications extends Notification
{
    use Queueable;

    protected $offer;
    protected $rejector;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($offer = null, $rejector = null)
    {
        $this->offer = $offer;
        $this->rejector = $rejector;
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
                    ->subject('Obaveštenje o odbijenom zahtevu')
                    ->greeting('Zdravo!')
                    ->line('Vaš zahtev je odbijen. Pokušajte zamenu sa drugim oglasima sa našeg sajta.')
                    ->action('Nastavite sa zamenama', url('/'))
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
        $rejectorName = $this->rejector ? $this->rejector->firstName . ' ' . $this->rejector->lastName : 'Nepoznato';
        $productName = $this->offer && $this->offer->product ? $this->offer->product->title : 'Proizvod';
        $offerProductName = $this->offer && $this->offer->sendproduct ? $this->offer->sendproduct->title : 'Vaš proizvod';
        
        return [
            'type' => 'exchange_rejected',
            'title' => 'Zahtev odbijen',
            'message' => "Žao nam je, {$rejectorName} je odbio vaš zahtev za zamenu: {$productName} za {$offerProductName}",
            'rejector_name' => $rejectorName,
            'rejector_id' => $this->rejector ? $this->rejector->id : null,
            'product_name' => $productName,
            'offer_product_name' => $offerProductName,
            'offer_id' => $this->offer ? $this->offer->id : null,
            'url' => url('/sendOffers'),
            'icon' => 'bx bx-x-circle',
            'color' => '#dc3545',
            'timestamp' => now()->toISOString(),
        ];
    }
}
