<?php

namespace App\Policies;

use App\TeacherPlan;
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
     * @param \App\TeacherPlan $idea
     * @return mixed
     */
    public function view(User $user, TeacherPlan $idea)
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
//        dd($user);
        return $user->isGranted(User::ROLE_TEACHER);
    }

    /**
     * Determine whether the user can update the teachers plans.
     *
     * @param \App\User $user
     * @param \App\TeacherPlan $teachersplans
     * @return mixed
     */
    public function update(User $user, TeacherPlan $teachersplans)
    {
        return $user->userable->id === $teachersplans->teachers_id;
    }

    /**
     * Determine whether the user can delete the teachers plans.
     *
     * @param \App\User $user
     * @param \App\TeacherPlan $teachersPlans
     * @return mixed
     */
    public function delete(User $user, TeacherPlan $teachersPlans)
    {
        return ($user->isGranted(User::ROLE_TEACHER ));
    }

    /**
     * Determine whether the user can restore the teachers plans.
     *
     * @param \App\User $user
     * @param \App\TeacherPlan $teachersPlans
     * @return mixed
     */
    public function restore(User $user, TeacherPlan $teachersPlans)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the teachers plans.
     *
     * @param \App\User $user
     * @param \App\TeacherPlan $teachersPlans
     * @return mixed
     */
    public function forceDelete(User $user, TeacherPlan $teachersPlans)
    {
        return $user->isGranted(User::ROLE_SUPERADMIN);
    }
}
