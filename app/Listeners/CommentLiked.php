<?php

namespace App\Listeners;

use App\Events\LikeComment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use App\Models\Comment;
use Log;

class CommentLiked
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
    public function handle(LikeComment $event): void
    {   
        $user = User::findOrFail($event->user->id);
        $alreadyLiked = $user->commentLike()->where('comment_id' , $event->comment->id)->exists();
        $comment = Comment::findOrFail($event->comment->id);
        if(!$alreadyLiked){
        $user->commentLike()->attach([
            'user_id' => $event->user->id,
            'comment_id' => $comment->id,
        ]);
        $user->commentLike()->attach($comment->id, [
            'likes' => 1
        ]);
    }else {
        Log::info('Comment already liked');
    }
    }
}
