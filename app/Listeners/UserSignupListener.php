<?php

namespace App\Listeners;

use App\Jobs\SendEmailSignupJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserSignupListener
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
        dispatch(new SendEmailSignupJob($details));
    }
}
