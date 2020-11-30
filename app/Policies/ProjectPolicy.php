<?php

namespace App\Policies;

use App\Project;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isGranted(User::ROLE_SUPERADMIN)) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any projects.
     *
     * @param \App\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //TODO add role ADMINISTRATIVE for this ability.
    }

    /**
     * Determine whether the user can view the project.
     *
     * @param \App\User $user
     * @param \App\Project $project
     * @return mixed
     */
    public function view(User $user, Project $project)
    {
        if ($user->userable->id === $project->teacher_id && $user->isGranted(User::ROLE_TEACHER)) {
            return true;
        } else {
            foreach ($project->students as $student) {
                if ($student->id === $user->id && $user->isGranted(User::ROLE_STUDENT)) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Determine whether the user can create projects.
     *
     * @param \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isGranted(User::ROLE_STUDENT);
    }

    /**
     * Determine whether the user can update the project.
     *
     * @param \App\User $user
     * @param \App\Project $project
     * @return mixed
     */
    public function update(User $user, Project $project)
    {
        if ( $user->isGranted(User::ROLE_TEACHER)) {
            return true;
        } else {
            foreach ($project->students as $student) {
                if ($student->id === $user->userable->id) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Determine whether the user can delete the project.
     *
     * @param \App\User $user
     * @param \App\Project $project
     * @return mixed
     */
    public function delete(User $user, Project $project)
    {
        return $user->isGranted(User::ROLE_ADMIN);
    }

    /**
     * Determine whether the user can restore the project.
     *
     * @param \App\User $user
     * @param \App\Project $project
     * @return mixed
     */
    public function restore(User $user, Project $project)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the project.
     *
     * @param \App\User $user
     * @param \App\Project $project
     * @return mixed
     */
    public function forceDelete(User $user, Project $project)
    {
        return $user->isGranted(User::ROLE_SUPERADMIN);
    }
}
