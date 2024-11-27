<?php

namespace App\Http\Controllers;
use App\Models\Post;

use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('recommender', 'user')->get();
        // dd($posts);
        return view('admin.posts', compact('posts'));
    }
    public function store(Request $request, User $user)
    {
        $validateData = $request->validate([
            'body' => 'required|string|max:255'
        ]);

        $validateData['recommender_id'] = auth()->id();
        $validateData['user_id'] = $user->id;

        Post::create($validateData);


        return redirect()->back()->with('succsess', 'Recommendation subbmitted succsessfully');
    }
    public function edit(Request $request, Post $post)
    {
        $validateData = $request->validate([
            'body' => 'required|string|max:255'
        ]);
        $post->update($validateData);

        return redirect()->back();

    }
    public function destroy(int $id)
    {
        Post::findOrFail($id)->delete();

        return redirect()->back();
    }
    public function show(User $user)
    {
        return redirect()->route('show.user', $user->id);
    }
}
