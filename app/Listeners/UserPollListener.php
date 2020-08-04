<?php

namespace App\Listeners;

use App\Jobs\SendEmailPollJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserPollListener
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
        $email = auth()->user()->email;
        $details['email'] = $email;
        dispatch(new SendEmailPollJob($details));
    }
}
