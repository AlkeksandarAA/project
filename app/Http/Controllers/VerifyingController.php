<?php

namespace App\Http\Controllers;

use App\Events\VerifiedEmail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;



class VerifyingController extends Controller
{
    public function verification(Request $request, $userId) {

        $user = User::findOrFail($userId);

        event(new VerifiedEmail($user));

        Auth::login($user);
            
        return redirect()->route('user.setup');
    }
}
