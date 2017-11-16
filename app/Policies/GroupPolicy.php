<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine whether the user can view the Group.
     *
     * @param  \App\User  $user
     * @param  \App\Group  $group
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
