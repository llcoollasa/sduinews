<?php

namespace App\Listeners;

use App\Events\NewsCreated;
use Illuminate\Support\Facades\Log;

class SendNewsCreatedNotification
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
     * @param  \App\Events\NewsCreated  $event
     * @return void
     */
    public function handle(NewsCreated $event)
    {
        Log::info("Message received: " . $event->news->title);
    }
}
