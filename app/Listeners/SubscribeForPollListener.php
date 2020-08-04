<?php

namespace App\Listeners;

use App\Jobs\SendEmailForSubscribeForPoll;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SubscribeForPollListener
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $user = $event->user->email;

        $details['email'] = $user;
        dispatch(new SendEmailForSubscribeForPoll($details));
    }
}
