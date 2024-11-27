<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Event;
use App\Models\Blogs;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        $purchesedTickets = Event::with(['PurcheseTickets'])->has('PurcheseTickets')->get();
        $events = Event::with(['guest', 'ticket', 'PurcheseTickets'])->get();
        $blogs = Blogs::query()->get();
        $posts = Post::with('recommender')->get();
        $conferences = Event::where('conference', true)->get();
        $admins = User::where('role_id', '2')->get();

        return view('admin.admin_dashboard', [
            'users' => $users,
            'events' => $events,
            'posts' => $posts,
            'purchesedTickets' => $purchesedTickets,
            'blogs' => $blogs,
            'conferences' => $conferences,
            'admins' => $admins,
        ]);
    }

}
