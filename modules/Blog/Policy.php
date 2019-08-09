<?php

namespace Modules\Blog;

use App\User;

use Illuminate\Auth\Access\HandlesAuthorization;

class Policy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        return $user->hasPerm('post.view');
    }

    public function create(User $user)
    {
        return $user->hasPerm('post.create');
    }

    public function update(User $user)
    {
        return $user->hasPerm('post.update');
    }

    public function delete(User $user)
    {
        return $user->hasPerm('post.delete');
    }
}