<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the Group.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(User $user)
    {
        return true;
    }

    public function manage($user)
    {
        $g = $user->group;
        if ($g) {
            return $user->group->name === 'Admin';
        }
        return false;
    }
}
