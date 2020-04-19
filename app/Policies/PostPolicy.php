<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class PostPolicy extends ContentPolicy
{
    use HandlesAuthorization;

    public function star(User $user, Post $post) {
        return $user->id != $post->content->author && $post->content->visible;
    }
}
