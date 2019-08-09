<?php

namespace Modules\Media;

use App\User;

use Illuminate\Auth\Access\HandlesAuthorization;

class Policy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        return $user->hasPerm('media.view');
    }

    public function create(User $user)
    {
        return $user->hasPerm('media.create');
    }

    public function update(User $user)
    {
        return $user->hasPerm('media.update');
    }

    public function delete(User $user)
    {
        return $user->hasPerm('media.delete');
    }
}
