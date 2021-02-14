<?php

namespace App\Policies;

use App\Models\Student;
use App\Models\User;
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
        return $user->isGranted(User::ROLE_SECRETARY);
    }

    /**
     * Determine whether the user can view the students.
     *
     * @param  \App\User  $user
     * @param  \App\Student  $students
     * @return mixed
     */
    public function view(User $user, Student $students)
    {
        return ($user->isGranted(User::ROLE_STUDENT) || $user->isGranted(User::ROLE_TEACHER));
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
     * @param  \App\Student  $students
     * @return mixed
     */
    public function update(User $user, Student $students)
    {
        return $user->isGranted(User::ROLE_ADMIN)||$user->isGranted(User::ROLE_STUDENT);
    }

    /**
     * Determine whether the user can delete the students.
     *
     * @param  \App\User  $user
     * @param  \App\Student  $students
     * @return mixed
     */
    public function delete(User $user, Student $students)
    {
        return $user->isGranted(User::ROLE_ADMIN);
    }

    /**
     * Determine whether the user can restore the students.
     *
     * @param  \App\User  $user
     * @param  \App\Student  $students
     * @return mixed
     */
    public function restore(User $user, Student $students)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the students.
     *
     * @param  \App\User  $user
     * @param  \App\Student  $students
     * @return mixed
     */
    public function forceDelete(User $user, Student $students)
    {
        //
    }
}
