<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class PostPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
      // Any user can create a new card
      // TODO: check if the user is not blocked
      return Auth::check() && $user->role != 'Blocked';
    }

    public function delete(User $user, Post $post)
    {
      // Only a card owner can delete it
      return $user->id == $post->author;
    }

    public function edit(User $user, Post $post)
    {
        // TODO: also check if the user is not blocked
        return $user->id == $post->author;
    }
}
