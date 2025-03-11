<?php

namespace App\Listeners;

use App\Events\OrderShippedEvent;
use App\Mail\OrderShipped;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class OrderShippedListener
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
    public function handle(OrderShippedEvent $event): void
    {
        Mail::to(auth()->user()->email)->send(new OrderShipped($event->order));
        
    }
}
