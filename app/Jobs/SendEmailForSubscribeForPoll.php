<?php

namespace App\Jobs;

use App\Mail\MailForSubscribeForPoll;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailForSubscribeForPoll implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $details;

    /**
     * Create a new job instance.
     *
     * @param $details
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new MailForSubscribeForPoll();
        Mail::to($this->details['email'])->send($email);
    }
}
