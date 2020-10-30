<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NewUserVerificationMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $email;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $token = Str::random(20);
        DB::table('mail_verification')->insert(['email' => $this->email,'token' => $token]);
        $verification_url = route('web.verifyEmail',['email' => $this->email,'token' => $token]);
        return $this->from('mohamdfawaz93@gmail.com')->view('email.verify_mail',compact('verification_url'));
    }
}
