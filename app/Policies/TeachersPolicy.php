<?php

namespace App\Policies;

use App\Teacher;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeachersPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any teachers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the teachers.
     *
     * @param  \App\User  $user
     * @param  \App\Teacher  $teachers
     * @return mixed
     */
    public function view(User $user, Teacher $teachers)
    {
        //
    }

    /**
     * Determine whether the user can create teachers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the teachers.
     *
     * @param  \App\User  $user
     * @param  \App\Teacher  $teachers
     * @return mixed
     */
    public function update(User $user, Teacher $teachers)
    {
        //
    }

    /**
     * Determine whether the user can delete the teachers.
     *
     * @param  \App\User  $user
     * @param  \App\Teacher  $teachers
     * @return mixed
     */
    public function delete(User $user, Teacher $teachers)
    {
        //
    }

    /**
     * Determine whether the user can restore the teachers.
     *
     * @param  \App\User  $user
     * @param  \App\Teacher  $teachers
     * @return mixed
     */
    public function restore(User $user, Teacher $teachers)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the teachers.
     *
     * @param  \App\User  $user
     * @param  \App\Teacher  $teachers
     * @return mixed
     */
    public function forceDelete(User $user, Teacher $teachers)
    {
        //
    }
}
