<?php

namespace App\Policies;

use App\User;
use App\Project;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the project.
     *
     * @param  \App\User  $user
     * @param  \App\Project  $project
     * @return mixed
     */
    public function update(User $user, Project $project)
    {
      if ($user->isAdmin()) {
          return true;
      }
      if ($user->id === $project->user_id) {
          return true;
      }

      return false;
    }

    /**
     * Determine whether the user can delete the project.
     *
     * @param  \App\User  $user
     * @param  \App\Project  $project
     * @return mixed
     */
    public function delete(User $user, Project $project)
    {
      if ($user->isAdmin()) {
          return true;
      }
      if ($user->id === $project->user_id) {
          return true;
      }

      return false;
    }

    public function edit(User $user, Project $post)
    {
        if ($user->isAdmin()) {
            return true;
        }
        if ($user->id === $project->user_id) {
            return true;
        }

        return false;
    }

}
