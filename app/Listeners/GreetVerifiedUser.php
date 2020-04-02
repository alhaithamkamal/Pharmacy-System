<?php

namespace App\Listeners;

use App\Notifications\WelcomeUser;
use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GreetVerifiedUser
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
     * @param  IlluminateAuthEventsVerified  $event
     * @return void
     */
    public function handle(Verified $event)
    {
        $event->user->notify(new WelcomeUser());
    }
}
