<?php

namespace App\Listeners;

use App\Events\SendEmailVerification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationMail;
use Illuminate\Support\Facades\Log;



class EmailVereficationNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SendEmailVerification $event): void
    {
      

        $user = $event->user;
        $verificationUrl = route('verify.email', ['user' => $user->id]);

        Mail::to($user->email)->send(new VerificationMail($user, $verificationUrl));
    }
}
