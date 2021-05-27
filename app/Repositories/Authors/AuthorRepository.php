<?php

namespace App\Repositories\Authors;

use App\Repositories\BaseRepository;

class AuthorRepository extends BaseRepository implements AuthorRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Author::class;
    }
}
