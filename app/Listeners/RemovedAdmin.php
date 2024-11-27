<?php

namespace App\Listeners;

use App\Events\AdminRemove;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RemovedAdmin
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
    public function handle(AdminRemove $event): void
    {
        $event->user->update(['role_id' => '1']);
        
    }
}
