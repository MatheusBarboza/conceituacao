<?php

namespace App\Repositories;

use App\Models\User;

class ProfileUserRepository
{
    public function sync(int $user, array $profiles): array
    {
        return User::find($user)->profiles()->sync($profiles);
    }

    public function getByUser(int $user): array
    {
        return User::find($user)->profiles()->get()->toArray();
    }
}