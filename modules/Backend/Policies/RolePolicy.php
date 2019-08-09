<?php

namespace Modules\Backend\Policies;

use App\User;

use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        return $user->has('admin');
    }

    public function create(User $user)
    {
        return $user->has('admin');
    }

    public function update(User $user)
    {
        return $user->has('admin');
    }

    public function delete(User $user)
    {
        return $user->has('admin');
    }
}
