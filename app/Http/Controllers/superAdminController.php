<?php

namespace App\Http\Controllers;

use App\Events\AdminRemove;
use App\Events\MakeAdmin;
use App\Models\User;
use Illuminate\Http\Request;

class superAdminController extends Controller
{
    public function updateAdmin(Request $request, User $user)
    {
        $message = '';
        if ($request->input('action') === 'make') {
            event(new MakeAdmin($user));
            $message = 'User role updated successfully.';
        } elseif ($request->input('action') === 'remove') {
            event(new AdminRemove($user));
            $message = 'User role updated successfully.';
        }
        ;


        return redirect()->back()->with($message);
    }
    public function index()
    {
        $admins = User::where('role_id', 2)->get();
        return view('admin.all_admins', compact('admins'));
    }
}
