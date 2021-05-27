<?php

namespace App\Repositories\Puplishers;

use App\Repositories\BaseRepository;

class PuplisherRepository extends BaseRepository implements PuplisherRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Puplisher::class;
    }
}
