<?php

namespace App\Http\Controllers;

use App\Models\Biography;
use App\Models\User;
use Illuminate\Http\Request;

class BiographyController extends Controller
{
    public function  update(Request $request , User $user) {

        $validateData = $request->validate([
            'title' => 'required|max:255',
            'biography' => 'required|max:255',
        ]);
        $validateData['user_id'] = $user->id;

        $biography = Biography::where('user_id', $user->id)->firstOrFail();

        $biography->update($validateData);

        return redirect()->back();
    }
}
