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
use DB;

class CRequestsController extends Controller
{
    public function create(Request $request)
    {
        $book = Book::find($request->book);
        if($book->amount > 0)
        {
            return view('client.requests.create', compact('book'));
        } else {

            return redirect()->route('client.books')->with('error', trans('books.nobook'));
        }
    }

    public function showone($id)
    {
        $crequest = Crequest::find($id);
        if ($crequest) {

            return view('client.requests.showone', ['request' => $crequest]);
        } else {
            
            return redirect()->back()->with('error', trans('requests.noexit'));
        }
    }

    public function store(CRequestsRequest $request)
    {
        $request->all();
        $exit_request = CRequest::where([['book_id', $request->book], ['user_id', Auth::id()]])->first();
        $book = Book::where('id', $request->book)->first();
        if($book->amount > 0)
        {
            if($exit_request)
            {

                return redirect()->route('client.books')->with('error', trans('request.exit'));
            } else {
                $trans = DB::transaction(function () use ($request, $book) {
                    $crequest = CRequest::create([
                        'book_id' => $request->book,
                        'user_id' => Auth::id(),
                        'borrow_day' => $request->borrowday,
                        'return_day' => $request->returnday,
                        'is_approve' => false,
                    ]);

                    $book->amount = $book->amount - 1;
                    $book->save();
                    
                    return $crequest;
                });
                
                if($trans)
                {
                    $users = User::where('role_id', 1)->get(); 
                    $data = ['user' => Auth::user()->name, 'book' => $book->name, 'title' => 'New request', 'link' => route('requests.showone', $trans->id)];
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

                    return redirect()->route('client.books')->with('success', trans('request.createsuccess'));
                } else {

                    return redirect()->route('client.books')->with('error', trans('request.createfail'));
                }
            }
        } else {

            return redirect()->route('client.books')->with('error', trans('books.nobook'));
        }    

    }
}
