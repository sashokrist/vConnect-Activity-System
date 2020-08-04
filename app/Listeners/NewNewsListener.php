<?php

namespace App\Listeners;

use App\Jobs\SendEmailForNewNewsJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewNewsListener
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
       // dd($event);
        dispatch(new SendEmailForNewNewsJob());
    }
}
