<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class UserPolicy{

    use HandlesAuthorization;

    public function showProfile(?User $user){
        return true;
    }

    public function showEditProfile(User $u1, User $u2){
        return $u1->id == $u2->id;
    }
  
}
