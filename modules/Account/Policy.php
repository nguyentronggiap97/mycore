<?php

namespace Modules\Account;

use App\User;
use Modules\Account\Models\Account;

use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\HandlesAuthorization;

class Policy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function view(User $user, Account $post)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Account $post)
    {
        return true;
    }

    public function delete(User $user, Account $post)
    {
        return true;
    }

    public function publish(User $user)
    {
        return true;
    }

    public function draft(User $user)
    {
        return true;
    }
}
