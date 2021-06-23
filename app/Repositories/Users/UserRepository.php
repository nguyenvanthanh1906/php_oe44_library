<?php

namespace App\Repositories\Users;

use App\Repositories\BaseRepository;
use App\Models\User;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function getModel()
    {

        return \App\Models\User::class;
    }

    public function getByRoleId($role)
    {
        
        return User::where('role_id', $role)->get();
    }
}
