<?php

namespace App\Policies;

use App\MedService;
use App\User;
use App\MedSmena;
use Illuminate\Auth\Access\HandlesAuthorization;

class MedSmenaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the medSmena.
     *
     * @param  \App\User  $user
     * @param  \App\MedSmena  $medSmena
     * @return mixed
     */
    public function view(User $user, MedSmena $medSmena)
    {
        //
    }

    /**
     * Determine whether the user can create medSmenas.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
    }

    /**
     * Determine whether the user can update the medSmena.
     *
     * @param  \App\User  $user
     * @param  \App\MedSmena  $medSmena
     * @return mixed
     */
    public function update(User $user, MedSmena $medSmena)
    {
        //
    }

    /**
     * Determine whether the user can delete the medSmena.
     *
     * @param  \App\User  $user
     * @param  \App\MedSmena  $medSmena
     * @return mixed
     */
    public function delete(User $user, MedSmena $medSmena)
    {
        //
    }
}
