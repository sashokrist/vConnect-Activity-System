<?php

namespace App\Listeners;

use App\Jobs\WelcomeEmailJob;
use App\Mail\WelcomeMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class WelcomeNewUser
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
        dispatch(new WelcomeEmailJob($details));
       // Mail::to($user)->send(new WelcomeMail());
    }
}
