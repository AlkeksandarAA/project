<?php

namespace App\Http\Controllers;
use App\Http\Requests\UserDetailsRequest;
use App\Models\Address;
use App\Models\Biography;
use App\Models\Resume;


class UserDetailController extends Controller
{
    public function store(UserDetailsRequest $request)
    {

        $validatedData = $request->validated();


        $address = new Address();
        $address->user_id = auth()->id();
        $address->street = $validatedData['street'];
        $address->city = $validatedData['city'];
        $address->country = $validatedData['country'];
        $address->postal_code = $validatedData['postal_code'];

        $address->save();

        $bio = new Biography();
        $bio->user_id = auth()->id();
        $bio->title = $validatedData['title'];
        $bio->biography = $validatedData['biography'];
        $bio->save();


        if ($request->hasFile('file_path')) {
            $filePath = $request->file('file_path')->store('public', 'public');
            $resume = new Resume();
            $resume->user_id = auth()->id();
            $resume->file_path = $filePath;
            $resume->save();
        }


        return redirect()->route('dashboard');

    }
}
