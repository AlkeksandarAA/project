<?php

namespace App\Http\Controllers;
use App\Events\FriendRequest;
use Illuminate\Support\Facades\Auth;
use app\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Notifications\FriendRequestNotification;

class FirendsController extends Controller
{
    public function send(Request $request, $userId){

        $user = User::findOrFail(Auth::id());
        $friend = User::find($userId);


        if ($user->id === (int)$userId) {
            return redirect()->back()->with('error', 'You cannot add yourself as a friend.');
        }

        $friend->notify(new FriendRequestNotification($user, $friend->id));
        event(new FriendRequest($user, $userId));



        return redirect()->back()->with(
            'succsess' , 'User added succsefully'
        );
        
    }
    public function accept($id) {
    
        $notification = auth()->user()->notifications()->find($id);
    
        if ($notification) {
            $friendId = $notification->data['friend_id'];
            

            auth()->user()->friends()->attach($friendId);
    
           
            $notification->markAsRead();

            $notification->delete();
    

            return redirect('user/dashboard')->with('success', 'Friend request accepted!');
        }
    
        return redirect('user/dashboard')->with('error', 'Friend request not found.');
        
    }
    public function reject($id)
{
    $notification = auth()->user()->notifications()->find($id);
    if ($notification) {

        $friendId = $notification->data['friend_id'];

        auth()->user()->friends()->detach($friendId);

        $notification->markAsRead();

        $notification->delete();

        return redirect('user/dashboard')->with('success', 'Friend request rejected!');
    }

    return redirect('user/dashboard')->with('error', 'Friend request not found.');
}
    public function unfriend($id){
        auth()->user()->friends()->detach($id);

        return redirect('user/dashboard')->with(
            'succsess' , 'User removed succsefully'
        );
    }

    }
