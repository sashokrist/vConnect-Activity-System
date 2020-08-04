<?php

namespace App\Listeners;

use App\Jobs\SendEmailForNewPollJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewPollListener
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
       //dd($event);
       // $user = $event->emails;
        //dd($user);

        //$details['email'] = $user;
        dispatch(new SendEmailForNewPollJob());
    }
}
