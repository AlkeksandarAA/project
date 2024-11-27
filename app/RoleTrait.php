<?php

namespace App;

use App\Models\User;
trait RoleTrait
{
    public function isSuperAdmin(User $user) {
        return $user->role_id === 3; 
    }

    public function isOwner($resource, User $user) {
        return $user->id === $resource->user_id; 
    }

    public function isAdmin(User $user){
        return $user->role_id === 2; 

    }


}
