<?php

namespace Modules\Backend\Policies;

use App\User;

use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view other user.
     *
     * @param  \App\User  $user     current user 
     * @param  \App\Post  $member   target user 
     * @return mixed
     */
    public function view(User $user, $target = null)
    {
        // Get target user from route
        $target = $target ?? request()->user;
        return $user->hasPerm('user.view') || $user->id == $target->id;
    }

    public function create(User $user)
    {
        return $user->hasPerm('user.create');
    }

    public function update(User $user, $target = null)
    {
        // Get target user from route
        $target = $target ?? request()->user;
        return $user->hasPerm('user.update') || $user->id == $target->id;
    }

    public function delete(User $user, $target)
    {
        return $user->hasPerm('user.delete');
    }

    public function password(User $user, $target = null)
    {
        // Get target user from route
        $target = $target ?? request()->user;
        return $user->hasPerm('user.password') || $user->id == $target->id;
    }
}
