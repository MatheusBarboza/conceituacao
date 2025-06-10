<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserRepository extends AbstractRepository
{
    protected $model = User::class;

    public function all(): Collection
    {
        return $this->model->with('profiles')->get();
    }

    public function find($id): ?Model
    {
        $user = $this->model->find($id);
        $user->load('profiles');
        return $user;
    }
}