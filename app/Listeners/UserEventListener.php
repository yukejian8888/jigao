<?php

namespace App\Listeners;

use App\Events\dede;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserEventListener implements ShouldQueue
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
     * @param  dede  $event
     * @return void
     */
    public function handle(dede $event)
    {
        //
    }
}
