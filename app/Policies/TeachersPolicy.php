<?php

namespace App\Policies;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeachersPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any teachers.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the teachers.
     *
     * @param User $user
     * @param Teacher $teachers
     * @return mixed
     */
    public function view(User $user, Teacher $teachers)
    {
        //
    }

    /**
     * Determine whether the user can create teachers.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isGranted(User::ROLE_SECRETARY);
    }

    /**
     * Determine whether the user can update the teachers.
     *
     * @param User $user
     * @param Teacher $teachers
     * @return mixed
     */
    public function update(User $user, Teacher $teachers)
    {
        //
    }

    /**
     * Determine whether the user can delete the teachers.
     *
     * @param User $user
     * @param Teacher $teachers
     * @return mixed
     */
    public function delete(User $user, Teacher $teachers)
    {
        //
    }

    /**
     * Determine whether the user can restore the teachers.
     *
     * @param User $user
     * @param Teacher $teachers
     * @return mixed
     */
    public function restore(User $user, Teacher $teachers)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the teachers.
     *
     * @param User $user
     * @param Teacher $teachers
     * @return mixed
     */
    public function forceDelete(User $user, Teacher $teachers)
    {
        //
    }
}
