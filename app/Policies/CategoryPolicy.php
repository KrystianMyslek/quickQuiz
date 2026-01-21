<?php

namespace App\Policies;

use App\Enums\userRole;
use App\Models\User;

class CategoryPolicy
{

    public function create(User $user): bool
    {
        return $user->role === userRole::Admin->value;
    }

    public function update(User $user): bool
    {
        return $user->role === userRole::Admin->value;
    }

    public function delete(User $user): bool
    {
        return $user->role === userRole::Admin->value;
    }
}
