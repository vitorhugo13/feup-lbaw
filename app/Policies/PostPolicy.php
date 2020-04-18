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
      return $user->role != 'Blocked';
    }

    public function delete(User $user, Post $post)
    {
      // Only a card owner can delete it
      return $user->id == $post->content->author;
    }

    public function edit(User $user, Post $post)
    {
        return $user->id == $post->content->author && $user->role != 'Blocked';
    }

    // TODO: rating policy
    // TODO: star policy
}
