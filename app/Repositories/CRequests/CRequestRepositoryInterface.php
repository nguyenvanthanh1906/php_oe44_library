<?php

namespace App\Repositories\CRequests;

use App\Repositories\RepositoryInterface;

interface CRequestRepositoryInterface extends RepositoryInterface
{
    public function findByBookAndUser($book, $user);
    public function paginateByIsApprove($isApprove);
    public function getByIsApprove($isApprove);
}
