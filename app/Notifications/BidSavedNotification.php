<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BidSavedNotification extends Notification
{
    use Queueable;

    protected $latestBidPrice;
    protected $userLastBidPrice;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($latest_bid_price, $user_last_bid_price)
    {
        $this->latestBidPrice = $latest_bid_price;
        $this->userLastBidPrice = $user_last_bid_price;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
            'latest_bid_price' => number_format($this->latestBidPrice, 2),
            'user_last_bid_price' => number_format($this->userLastBidPrice, 2)
        ];
    }
}
