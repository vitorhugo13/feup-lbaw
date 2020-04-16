<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class CardPolicy
{
    use HandlesAuthorization;

    // 
    public function show(?User $user, Post $post)
    {
      // TODO: check if the post is visible
      return true;
    }

    public function list(User $user)
    {
      // Any user can list its own cards
      return Auth::check();
    }

    public function create(User $user)
    {
      // Any user can create a new card
      // TODO: check if the user is not blocked
      return Auth::check();
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
