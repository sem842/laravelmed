<?php

namespace App\Policies;

use App\User;
use App\MedService;
use Illuminate\Auth\Access\HandlesAuthorization;

class MedServicePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the medService.
     *
     * @param  \App\User  $user
     * @param  \App\MedService  $medservice
     * @return mixed
     */
    public function view(User $user, MedService $medservice)
    {
        //
    }

    /**
     * Determine whether the user can create medServices.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user, MedService $medservice)
    {
        if ($user->group->id == $medservice->group_id) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can update the medService.
     *
     * @param  \App\User  $user
     * @param  \App\MedService  $medservice
     * @return mixed
     */
    public function update(User $user, MedService $medservice)
    {
        /*if ($user->group->id == $medservice->group_id) {
            return true;
        } else {
            return false;
        }*/
    }

    /**
     * Determine whether the user can delete the medService.
     *
     * @param  \App\User  $user
     * @param  \App\MedService  $medservice
     * @return mixed
     */
    public function delete(User $user, MedService $medservice)
    {
        //
    }
}
