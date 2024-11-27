<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\FriendRequest;
use Illuminate\Support\Facades\Log;
class FriendRequestSent
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
    public function handle(FriendRequest $event): void
    {
        $alreadyFriends = $event->user->friends()->wherePivot('friend_id', $event->friendId)->exists();
        if(!$alreadyFriends){
        $event->user->friends()->attach($event->friendId);
        }else {
            Log::info('Users are already friends: ' . $event->user->id . ' and ' . $event->friendId);
        }
    }
}
