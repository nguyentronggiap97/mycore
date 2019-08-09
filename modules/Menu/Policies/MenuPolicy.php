<?php

namespace Modules\Menu\Policies;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MenuPolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        return $user->hasPerm('menu.view');
    }

    public function create(User $user)
    {
        return $user->hasPerm('menu.create');
    }

    public function update(User $user)
    {
        return $user->hasPerm('menu.update');
    }

    public function delete(User $user)
    {
        return $user->hasPerm('menu.delete');
    }
}