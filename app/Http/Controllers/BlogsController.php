<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blogs;
use App\Models\Comment;
use App\Http\Requests\BlogRequest;


class BlogsController extends Controller
{
    public function index() {
     $blogs = Blogs::with('comments' , 'user')->get();  
        $replies = Comment::with('replies')->get();

     return view('user.blogs' , compact('blogs' , 'replies'));
    }

    public function show(int $id){
        $blog = Blogs::with(['comments' => function ($query) {
            $query->with(['replies.user' => function ($query) {
                $query->limit(1)->latest();
            }]);
        }, 'user'])->findOrFail($id);

        return view('user.blog', compact('blog'));
    }
    public function destroy(Blogs $blog){

        $blog->delete();

        return redirect()->route('all.blogs');
    }
    public function create() {
        return view('user.create_blog');
    }
    public function store(BlogRequest $blogRequest){
        
        $validatedData = $blogRequest->validated();

        $validatedData['user_id'] = auth()->user()->id;

        Blogs::create($validatedData);

        return redirect()->route('all.blogs');

    }


    public function edit(Blogs $blog){
        return view ('user.edit_blog', compact('blog'));
    }

    public function update(BlogRequest $blogRequest, Blogs $blog){

        $validatedData = $blogRequest->validated();

        $blog->update($validatedData);


        return redirect()->route('show.blog', $blog->id);

    }

    public function userBlogs(){

        $user = auth()->user()->id;

        $blogs = Blogs::where('user_id' , $user)->get();

        return view('user.user_blogs', compact('blogs'));

    }
}
