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

    public function changePermissions(User $requester){
        return $requester->role == 'Administrator';
    }

    public function block(User $requester, User $requestee){
        //Only Admins and Mods can block; only Members can be blocked
        return ($requester->role == 'Administrator' || $requester->role == 'Moderator') && $requestee->role == 'Member';
    }

    public function delete(User $user, User $owner){
        return $user != null && $owner != null && $user->id == $owner->id;
    }
}
