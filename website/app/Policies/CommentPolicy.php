<?php

namespace App\Policies;


use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy extends ContentPolicy
{
    use HandlesAuthorization;

}
