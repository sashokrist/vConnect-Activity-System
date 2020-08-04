<?php

namespace App\Providers;

use App\Events\NewMassageEvent;
use App\Events\NewNewsEvent;
use App\Events\NewPollEvent;
use App\Events\NewSignupEvent;
use App\Events\NewUserHasRegisterEvent;
use App\Events\RegisterForMassageEvent;
use App\Events\SubscribeForNewsEvent;
use App\Events\SubscribeForPollEvent;
use App\Events\SubscribeForSignupEvent;
use App\Events\UserMassageEvent;
use App\Events\UserPollEvent;
use App\Events\UserSignupEvent;
use App\Listeners\NewMassageListener;
use App\Listeners\NewNewsListener;
use App\Listeners\NewPollListener;
use App\Listeners\NewSignupListener;
use App\Listeners\RegisterForMassage;
use App\Listeners\RegisterForNews;
use App\Listeners\RegisterForPoll;
use App\Listeners\RegisterForSignup;
use App\Listeners\SubscrabeForMassageListener;
use App\Listeners\SubscribeForNewsListener;
use App\Listeners\SubscribeForPollListener;
use App\Listeners\SubscribeForSignupListene;
use App\Listeners\UserMassageListener;
use App\Listeners\UserPollListener;
use App\Listeners\UserSignupListener;
use App\Listeners\WelcomeNewUser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        /*Registered::class => [
            SendEmailVerificationNotification::class,
        ],*/
        NewUserHasRegisterEvent::class => [
            WelcomeNewUser::class,
        ],

        RegisterForMassageEvent::class => [
            SubscrabeForMassageListener::class,
        ],

        SubscribeForNewsEvent::class => [
            SubscribeForNewsListener::class,
        ],

        SubscribeForPollEvent::class => [
            SubscribeForPollListener::class,
        ],

        SubscribeForSignupEvent::class => [
            SubscribeForSignupListene::class,
        ],

        NewPollEvent::class => [
            NewPollListener::class,
        ],

        NewNewsEvent::class => [
          NewNewsListener::class,
        ],

        NewMassageEvent::class => [
            NewMassageListener::class,
        ],

        NewSignupEvent::class => [
            NewSignupListener::class,
        ],

        UserSignupEvent::class => [
            UserSignupListener::class,
        ],

        UserPollEvent::class =>[
            UserPollListener::class,
        ],

        UserMassageEvent::class => [
            UserMassageListener::class,
        ],


    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
