<?php

namespace App\Repositories\Statuses;

use App\Repositories\BaseRepository;

class StatusRepository extends BaseRepository implements StatusRepositoryInterface
{
    public function getModel()
    {
        
        return \App\Models\Status::class;
    }
}
