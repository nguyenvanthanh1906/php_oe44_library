<?php

namespace App\Repositories\CRequests;

use App\Repositories\BaseRepository;
use App\Models\CRequest;

class CRequestRepository extends BaseRepository implements CRequestRepositoryInterface
{
    public function getModel()
    {

        return CRequest::class;
    }

    public function findByBookAndUser($book, $user)
    {

        return CRequest::where([['book_id', $book], ['user_id', $user]])->first();
    }

    public function paginateByIsApprove($isApprove)
    {

        return CRequest::where('is_approve', $isApprove)->paginate(config('app.limit'));
    }

    public function getByIsApprove($isApprove)
    {

        return CRequest::where('is_approve', $isApprove)->get();
    }
}
