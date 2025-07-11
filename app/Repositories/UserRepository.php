<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function findByUsername(string $username): ?User
    {
        return User::where('username', $username)->first();
    }
}
