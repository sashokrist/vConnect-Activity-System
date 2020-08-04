<?php

namespace App\Jobs;

use App\SubscribeUser;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailForNewSignupJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //$users = SubscribeUser::where('subscribe_title', 'Signup')->get();
        $users = User::with('subscribe')->get();
        foreach ($users as $user) {
            $emails = array($user->email);
            Mail::send('signup.new-signup', [], function ($message) use ($emails) {
                $message->to($emails)->subject('Activity System- new Signup is ready');
            });
        }
    }
}
