<?php

namespace App\Http\Controllers;

use App\Models\Replies;
use Illuminate\Http\Request;
use App\Http\Requests\RepliesRequest;

class RepliesController extends Controller
{
    public function destroy(int $id) {
        $reply = Replies::find($id);
        $reply->delete();

        return redirect()->back();
    }
    public function store(RepliesRequest $request, int $id){
        $validated = $request->validated();

        $validated['user_id'] = auth()->user()->id;
        $validated['comment_id'] = $id;

        Replies::create($validated);

        return redirect()->back();
    }

    public function edit(RepliesRequest $request,int $id){
         $validateData = $request->validated();
        $reply = Replies::findOrFail($id);
        
        $reply->update($validateData);

        return redirect()->back();
    }
}
