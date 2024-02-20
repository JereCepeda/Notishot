<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function updatePermissions(User $admin, User $user)
    {
        return $admin->hasRole('admin');
    }
    public function listUsers(User $admin, User $user)
    {
        return $admin->hasRole('admin');
    }

    public function blockUser(User $admin, User $user)
    {
        return $admin->hasRole('admin');
    }
}
