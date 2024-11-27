<?php

namespace App\Http\Middleware;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Replies;
use App\Models\User;

use App\RoleTrait;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ResourceOwner
{
    use RoleTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response {

        $userid = auth()->user()->id;

        $user = User::findOrFail($userid);

    
        $commentId = $request->route('comment');
        $replyId = $request->route('reply');
        $postId = $request->route('post');
        $blog = $request->route('blog');

        $isSuperAdmin = $this->isSuperAdmin($user);
        $isAdmin = $this->isAdmin($user);

        if ($commentId && $this->isOwner(Comment::find($commentId), $user)) {
            return $next($request);
        }

        if ($replyId && $this->isOwner(Replies::find($replyId), $user)) {
            return $next($request);
        }

        if ($postId && $this->isOwner(Post::find($postId), $user)) {
            return $next($request);
        }

        if($blog->id && $this->isOwner($blog, $user)){
            return $next($request);
        }

        if ($isSuperAdmin) {
            return $next($request);
        }

        if($isAdmin){
            return $next($request);
        }



        return redirect()->back()->with('unauthorized', 403);
    }

}
