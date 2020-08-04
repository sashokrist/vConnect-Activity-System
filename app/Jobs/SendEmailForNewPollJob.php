<?php

namespace App\Jobs;

use App\Mail\MailForNewPoll;
use App\SubscribeUser;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailForNewPollJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /**
     * Create a new job instance.
     *
     * @param $details
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        /*$email = new MailForNewPoll();
        Mail::to($this->details['email'])->send($email);*/
       // $users = SubscribeUser::where('subscribe_title', 'Poll')->get();
        $users = User::with('subscribe')->get();
        foreach ($users as $user) {
            $emails = array($user->email);
            Mail::send('polls.new-poll-email', [], function ($message) use ($emails) {
                $message->to($emails)->subject('Activity System- new poll is ready');
            });
        }
    }
}
