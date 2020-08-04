<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Massage extends Mailable
{
    public $time;
    use Queueable, SerializesModels;


    public function __construct()
    {

    }


    public function build()
    {
       return $this->subject('Mail from Activity System')
          ->view('time-slot.massage');
       // return $this->view('time-slot.massage');

    }
}
