<?php

namespace App\Listeners;

use App\Events\VerifiedEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use \App\Models\User;

class UpdateVerifiedEmail
{
    /**
     * Create the event listener.
     */
    public function __construct(public User $user)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(VerifiedEmail $event): void
    {
        $event->user->update(['email_verified_at' => now()]);
    }
}
