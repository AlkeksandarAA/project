<?php

namespace App\Http\Middleware;

use App\RoleTrait;
use App\Models\User;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NormalAdmin
{
    use RoleTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userid = auth()->user()->id;
        
        $user = User::findOrFail($userid); 
        
        $isSuperAdmin = $this->isSuperAdmin($user);
        $isAdmin = $this->isAdmin($user);

        if ($isSuperAdmin || $isAdmin) {
            return $next($request);
        }

        return redirect()->back()->with('unauthorized' , 401);
    }
}
