<?php

namespace App\Listeners;

use App\Events\BadgeAwarded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AwardBadgeListener
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
    public function handle(BadgeAwarded $event): void
    {
        $event->user->badges()->create([
            'badge' => $event->badgeType,
        ]);
    }
}
