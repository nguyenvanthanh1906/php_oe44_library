<?php

namespace App\Http\Controllers\client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\CRequest;
use App\Notifications\CRequestNotification;
use App\Models\User;
use App\Http\Requests\CRequestsRequest;
use Pusher\Pusher;

class CRequestsController extends Controller
{
    public function create(Request $request)
    {
        $book = (new Book)->find($request->book);
        if($book->amount > 0)
        {

            return view('client.requests.create', compact('book'));
        } else {

            return redirect()->route('client.books')->with('error', trans('books.nobook'));
        }
    }

    public function store(CRequestsRequest $request)
    {
        $request->all();
        $exit_request = (new CRequest)->where([['book_id', $request->book], ['user_id', Auth::id()]])->first();
        $book = (new Book)->where('id', $request->book)->first();
        if($book->amount > 0)
        {
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
                    $book->amount = $book->amount - 1;
                    $book->save();

                    $users = (new User)->where('role_id', 1)->get(); 
                    $data = ['user' => Auth::user()->name, 'book' => $book->name];
                    foreach($users as $user)
                    {
                        $user->notify(new CRequestNotification($data));
                    }
                    $options = array(
                        'cluster' => 'ap1',
                        'encrypted' => true
                    );
            
                    $pusher = new Pusher(
                        env('PUSHER_APP_KEY'),
                        env('PUSHER_APP_SECRET'),
                        env('PUSHER_APP_ID'),
                        $options
                    );
            
                    $pusher->trigger('NotificationEvent', 'send-message', $data);

                    return redirect()->route('client.books')->with('success', trans('requests.createsuccess'));
                } else {

                    return redirect()->route('client.books')->with('error', trans('request.createfail'));
                }
            }
        } else {
            return redirect()->route('client.books')->with('error', trans('books.nobook'));
        }    


    }
}
