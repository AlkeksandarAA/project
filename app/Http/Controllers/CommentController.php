<?php

namespace App\Http\Controllers;

use App\Badges\FirstLike;
use App\Events\LikeComment;
use App\Http\Requests\CommentRequest;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;
use App\Events\BadgeAwarded;

class CommentController extends Controller
{
    public function likeComment(User $user, Comment $comment){
        
        event(new LikeComment($user, $comment));
        event(new BadgeAwarded($user,  FirstLike::class));
        return redirect()->back()->with('succsess', 'Liked comment');
    }

    public function destory($id) {
        Comment::destroy($id);

        return redirect()->back()->with('susscess', 200);
    }

    public function show(Comment $comment) {
        $comment->load('replies.user', 'like' , 'user');
        return view('user.comment_replies', compact('comment'));
    }

    // public function create(){
    //     return view('user.submit_comment');
    // }
    public function store( $id,CommentRequest $commentRequest){

        // dd($id, $commentRequest);

        $comment = $commentRequest->validated();

        $comment['blog_id'] = $id;
        $comment['user_id'] = auth()->id(); 

        Comment::create($comment);

        return redirect()->back()->with(200);
    }  
    public function edit($id){

        $comment = Comment::findOrFail($id);    

        return view('user.edit_comment', compact('comment'));
    }
    public function update(CommentRequest $request ,$id){

        $data = $request->validated();
        $comment = Comment::findOrFail($id);
        $comment->update($data);
        // return redirect()->route();
    }


}
