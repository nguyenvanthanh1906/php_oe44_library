<?php

namespace App\Http\Controllers\client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\CRequest;
use App\Http\Requests\CRequestsRequest;

class CRequestsController extends Controller
{
    public function create(Request $request)
    {
        $book = (new Book)->find($request->book);

        return view('client.requests.create', compact('book'));
    }

    public function store(CRequestsRequest $request)
    {
        $request->all();
        $exit_request = (new CRequest)->where([['book_id', $request->book], ['user_id', Auth::id()]])->first();
        if($exit_request)
        {

            return redirect()->route('client.books')->with('error', trans('requests.exit'));
        } else {
            $request = CRequest::create([
                'book_id' => $request->book,
                'user_id' => Auth::id(),
                'borrow_day' => $request->borrowday,
                'return_day' => $request->payday,
                'is_approve' => false,
            ]);
            if($request)
            {

                return redirect()->route('client.books')->with('success', trans('requests.createsuccess'));
            } else {

                return redirect()->route('client.books')->with('error', trans('request.createfail'));
            }
        }


    }
}
