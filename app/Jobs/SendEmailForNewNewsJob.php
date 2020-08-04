<?php

namespace App\Jobs;

use App\Subscribe;
use App\SubscribeUser;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailForNewNewsJob implements ShouldQueue
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

        $users = User::with('subscribe')->get();
//dd($users);
       // $users = SubscribeUser::where('subscribe_title', 'News')->get();
        foreach ($users as $user) {
            $emails = array($user->email);
            Mail::send('posts.new-post', [], function ($message) use ($emails) {
                $message->to($emails)->subject('Activity System- new News is ready');
            });
        }
    }
}
