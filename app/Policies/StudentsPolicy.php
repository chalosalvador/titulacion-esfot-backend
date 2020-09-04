<?php

namespace App\Policies;

use App\Students;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StudentsPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isGranted(User::ROLE_SUPERADMIN)) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any students.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the students.
     *
     * @param  \App\User  $user
     * @param  \App\Students  $students
     * @return mixed
     */
    public function view(User $user, Students $students)
    {
        return ($user->isGranted(User::ROLE_STUDENT));
    }

    /**
     * Determine whether the user can create students.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the students.
     *
     * @param  \App\User  $user
     * @param  \App\Students  $students
     * @return mixed
     */
    public function update(User $user, Students $students)
    {
        return $user->isGranted(User::ROLE_ADMIN)||$user->isGranted(User::ROLE_STUDENT);
    }

    /**
     * Determine whether the user can delete the students.
     *
     * @param  \App\User  $user
     * @param  \App\Students  $students
     * @return mixed
     */
    public function delete(User $user, Students $students)
    {
        return $user->isGranted(User::ROLE_ADMIN);
    }

    /**
     * Determine whether the user can restore the students.
     *
     * @param  \App\User  $user
     * @param  \App\Students  $students
     * @return mixed
     */
    public function restore(User $user, Students $students)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the students.
     *
     * @param  \App\User  $user
     * @param  \App\Students  $students
     * @return mixed
     */
    public function forceDelete(User $user, Students $students)
    {
        //
    }
}
