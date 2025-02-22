<?php

namespace App\Listeners;

use App\Events\OrderPlacedEvent;
use App\Mail\OrderShipped;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class OrderPlacedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderPlacedEvent $event): void
    {
        Mail::to('masudimubashir@gmail.com')->send(new OrderShipped($event->order));
    }
}
