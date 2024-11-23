<?php

namespace App\Listeners;

use App\Events\BidSaved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use App\Notifications\BidSavedNotification as BidSavedNotification;

class NotifyUsersOnBidSaved
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\BidSaved  $event
     * @return void
     */
    public function handle(BidSaved $event)
    {
        $latest_bid_price = $event->bid->price;

        foreach (User::all() as $user) {
            $user_last_bid_price = $user->bids()->latest()->first()?->price ?? 0.00;
            $user->notify(new BidSavedNotification($latest_bid_price, $user_last_bid_price));
        }
    }
}
