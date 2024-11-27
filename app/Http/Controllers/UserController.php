<?php

namespace App\Http\Controllers;
use App\Events\SendEmailVerification;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use \App\Models\Post;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all()->filter(function ($user) {
            return $user->id !== auth()->user()->id;
        });

        return view('user.all_users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.sign_up');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $validatedData = $request->validated();

        if (isset($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        $user = User::create($validatedData);
        $user->isAwarded();
        event(new SendEmailVerification($user));

        Auth::login($user);

        return view('verification.notice');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with('bio', 'address', 'resume')->findOrFail($id);

        $posts = Post::where('user_id', $user->id)
            ->with('recommender')
            ->get();


        return view('user.user_profile', compact('user', 'posts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $validateData = $request->validated();
        $user = User::findOrFail($id);
        $user->update($validateData);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function logOut(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('succsess', 'You have been logged out');
    }
    public function showFriends(User $user)
    {
        $user = User::with('friends')->findOrFail($user->id);

        return view('user.friends', compact('user'));
    }
}
