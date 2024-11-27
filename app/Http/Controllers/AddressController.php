<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function update(Request $request, User $user){

        $validatedData = $request->validate([
            'street' => 'required|max:25',
            'city' => 'required|max:25',
            'country' => 'required|max:25',
            'postal_code' => 'required|numeric',
        ]);

        $validatedData['user_id'] = $user->id;

        $address = Address::where('user_id' , $user->id)->firstOrFail();;

        $address->update($validatedData);
    

        return redirect()->back();
    }
}
