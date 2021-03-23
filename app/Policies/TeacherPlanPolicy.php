<?php

namespace App\Policies;

use App\Models\TeacherPlan;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeacherPlanPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isGranted(User::ROLE_SUPERADMIN)) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any teacher plans.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the teacher plan.
     *
     * @param User $user
     * @param TeacherPlan $teacherPlan
     * @return mixed
     */
    public function view(User $user, TeacherPlan $teacherPlan)
    {
        //
    }

    /**
     * Determine whether the user can create teacher plans.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
//        dd($user);
        return $user->isGranted(User::ROLE_TEACHER);
    }

    /**
     * Determine whether the user can update the teacher plan.
     *
     * @param User $user
     * @param TeacherPlan $teacherPlan
     * @return mixed
     */
    public function update(User $user, TeacherPlan $teacherPlan)
    {
        //
    }

    /**
     * Determine whether the user can delete the teacher plan.
     *
     * @param User $user
     * @param TeacherPlan $teacherPlan
     * @return mixed
     */
    public function delete(User $user, TeacherPlan $teacherPlan)
    {
        //
    }

    /**
     * Determine whether the user can restore the teacher plan.
     *
     * @param User $user
     * @param TeacherPlan $teacherPlan
     * @return mixed
     */
    public function restore(User $user, TeacherPlan $teacherPlan)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the teacher plan.
     *
     * @param User $user
     * @param TeacherPlan $teacherPlan
     * @return mixed
     */
    public function forceDelete(User $user, TeacherPlan $teacherPlan)
    {
        //
    }
}
