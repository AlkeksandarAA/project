<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Biography;
use App\Models\User;
use App\Models\Resume;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\Ticket;




class DashboardController extends Controller
{
   public function index() {
    $userId = Auth::id(); 

    $user = User::where('id', $userId)->first();
    $address = Address::where('user_id', $userId)->first(); 
    $biography = Biography::where('user_id', $userId)->first(); 
    $resume = Resume::where('user_id', $userId)->first();
    $events = Event::with(['guest' , 'PurcheseTickets' , 'ticket'])
    ->paginate(5);
    foreach ($events as $event) {
        $event->user_has_ticket = $user->PurcheseTickets->contains($event->id);
    }
    $posts = Post::with('recommender')
    ->where('user_id', auth()->id()) 
    ->get();

    $friendsofUser = User::where('id' , auth()->id())->first();
    $friends = $friendsofUser->friends()->paginate(3);

    return view('dashboard', [
        'user' => $user, 
        'address' => $address,
        'biography' => $biography,
        'resume' => $resume,
        'events' => $events,
        'posts' => $posts,
        'friends' => $friends,
    ]);
}
   }
