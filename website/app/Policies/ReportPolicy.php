<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Content;
use App\Models\Report;
use App\Models\ReportFile;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class ReportPolicy
{
    use HandlesAuthorization;

    public function show(User $user) {
        return $user->role === 'Moderator' || $user->role === 'Administrator';
    }

    public function createReport(User $user) {
        return $user->role !== 'Blocked';
    }

    public function deleteReport(User $user) {
        return $user->role === 'Moderator' || $user->role === 'Administrator';
    }

    public function sortReport(User $user) {
        return $user->role === 'Moderator' || $user->role === 'Administrator';
    }

    public function contestReport(User $user) {
        return $user->role === 'Blocked';
    }

    public function sortContest(User $user) {
        return $user->role === 'Moderator' || $user->role === 'Administrator';
    }
}