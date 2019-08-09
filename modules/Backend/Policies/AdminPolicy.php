<?php

namespace Modules\Backend\Policies;

use App\User;

use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        return $user->hasPerm('backend.view');
    }

    public function admin(User $user)
    {
        return $user->hasPerm('backend.admin');
    }

    public function create(User $user)
    {
        return $user->hasPerm('backend.create');
    }

    public function update(User $user)
    {
        return $user->hasPerm('backend.update');
    }

    public function delete(User $user)
    {
        return $user->hasPerm('backend.delete');
    }

    public function publish(User $user)
    {
        return $user->hasPerm('backend.publish');
    }

    public function draft(User $user)
    {
        return $user->hasPerm('backend.draft');
    }
}
