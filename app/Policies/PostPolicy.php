<?php

namespace App\Policies;

use App\Incidencia;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any incidencias.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the incidencia.
     *
     * @param  \App\User  $user
     * @param  \App\Incidencia  $incidencia
     * @return mixed
     */
    public function view(User $user, Incidencia $incidencia)
    {
        //
        return $user->id===$incidencia->profesorId;
        
    }

    /**
     * Determine whether the user can create incidencias.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the incidencia.
     *
     * @param  \App\User  $user
     * @param  \App\Incidencia  $incidencia
     * @return mixed
     */
    public function update(User $user, Incidencia $incidencia)
    {
        //
    }

    /**
     * Determine whether the user can delete the incidencia.
     *
     * @param  \App\User  $user
     * @param  \App\Incidencia  $incidencia
     * @return mixed
     */
    public function delete(User $user, Incidencia $incidencia)
    {
        //
    }

    /**
     * Determine whether the user can restore the incidencia.
     *
     * @param  \App\User  $user
     * @param  \App\Incidencia  $incidencia
     * @return mixed
     */
    public function restore(User $user, Incidencia $incidencia)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the incidencia.
     *
     * @param  \App\User  $user
     * @param  \App\Incidencia  $incidencia
     * @return mixed
     */
    public function forceDelete(User $user, Incidencia $incidencia)
    {
        //
    }
}
