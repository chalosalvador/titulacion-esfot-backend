<?php

namespace App\Policies;

use App\TeachersPlans;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeachersPlansPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isGranted(User::ROLE_SUPERADMIN)) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view any teachers plans.
     *
     * @param \App\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {

    }

    /**
     * Determine whether the user can view the teachers plans.
     *
     * @param \App\User $user
     * @param \App\TeachersPlans $idea
     * @return mixed
     */
    public function view(User $user, TeachersPlans $idea)
    {
        return $user->id === $idea->teacher_id;
    }

    /**
     * Determine whether the user can create teachers plans.
     *
     * @param \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isGranted(User::ROLE_TEACHER);
    }

    /**
     * Determine whether the user can update the teachers plans.
     *
     * @param \App\User $user
     * @param \App\TeachersPlans $teachersplans
     * @return mixed
     */
    public function update(User $user, TeachersPlans $teachersplans)
    {
        return $user === $teachersplans->teachers_id;
    }

    /**
     * Determine whether the user can delete the teachers plans.
     *
     * @param \App\User $user
     * @param \App\TeachersPlans $teachersPlans
     * @return mixed
     */
    public function delete(User $user, TeachersPlans $teachersPlans)
    {
        return ($user->isGranted(User::ROLE_TEACHER || $user->isGranted(User::ROLE_SUPERADMIN)));
    }

    /**
     * Determine whether the user can restore the teachers plans.
     *
     * @param \App\User $user
     * @param \App\TeachersPlans $teachersPlans
     * @return mixed
     */
    public function restore(User $user, TeachersPlans $teachersPlans)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the teachers plans.
     *
     * @param \App\User $user
     * @param \App\TeachersPlans $teachersPlans
     * @return mixed
     */
    public function forceDelete(User $user, TeachersPlans $teachersPlans)
    {
        return $user->isGranted(User::ROLE_SUPERADMIN);
    }
}
