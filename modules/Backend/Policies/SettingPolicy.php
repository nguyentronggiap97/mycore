<?php

namespace Modules\Backend\Policies;

use App\User;

use Illuminate\Auth\Access\HandlesAuthorization;

class SettingPolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        return $user->hasPerm('setting.view');
    }

    public function create(User $user)
    {
        return $user->hasPerm('setting.create');
    }

    public function update(User $user)
    {
        return $user->hasPerm('setting.update');
    }

    public function delete(User $user)
    {
        return $user->hasPerm('setting.delete');
    }
}
