<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Content;

use Illuminate\Auth\Access\HandlesAuthorization;

class ContentPolicy
{
    use HandlesAuthorization;

    public function show(?User $user, Content $content) {
        if ($user === null)
            return $content->visible;
        else if ($content->author === $user->id)
            return true;
        else if ($user->role === 'Moderator' || $user->role === 'Administrator')
            return true;
    
        return false;
    }

    public function create(User $user) {
        return $user->role != 'Blocked';
    }

    public function delete(User $user, Content $content) {
        return $user->id == $content->author || $user->role == 'Moderator' || $user->role == 'Administrator';
    }

    public function edit(User $user, Content $content) {
        return $user->id == $content->author && $user->role != 'Blocked';
    }

    public function rating(User $user, Content $content) {
        return $user->role != 'Blocked' && $content->visible;
    }

    public function report(User $user, Content $content) {
        return $user->role !== 'Blocked' && $content->author !== $user->id;
    }
}
