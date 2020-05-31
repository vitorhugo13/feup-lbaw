<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Content;
use App\Models\Report;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class ReportPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, Report $report) {
        return true;
    }


}