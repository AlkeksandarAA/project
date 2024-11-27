<?php

namespace App\Listeners;

use App\Events\MakeAdmin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserIsAdmin
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
    public function handle(MakeAdmin $event): void
    {

        $event->user->update(['role_id' => '2']);
    }
}
