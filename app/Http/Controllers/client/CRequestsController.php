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
use App\Repositories\CRequests\CRequestRepositoryInterface;
use App\Repositories\Users\UserRepositoryInterface;


class CRequestsController extends Controller
{
    protected $crequestRepo, $userRepo;
    public function __construct(CRequestRepositoryInterface $crequestRepo, UserRepositoryInterface $userRepo)
    {
        $this->crequestRepo = $crequestRepo;
        $this->userRepo = $userRepo;
    }

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
        $exit_request = $this->crequestRepo->findByBookAndUser($request->book, Auth::user()->id);
        $book = Book::find($request->book);
        if($book->amount > 0)
        {
            if($exit_request)
            {

                return redirect()->route('client.books')->with('error', trans('requests.exit'));
            } else {
                DB::beginTransaction();
                try {
                    $crequest = CRequest::create([
                        'book_id' => $request->book,
                        'user_id' => Auth::id(),
                        'borrow_day' => $request->borrowday,
                        'return_day' => $request->returnday,
                        'is_approve' => false,
                    ]);

                    $book->amount = $book->amount - 1;
                    $book->save();

                    $users = $this->userRepo->getByRoleId(1); 
                    $data = ['user' => Auth::user()->name, 'content' => Auth::user()->name.' -> '.$book->name,'time' => date("d-m-Y H:i:s"), 'title' => 'New request', 'link' => route('requests.showone', $crequest->id)];
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
                    
                    DB::commit();
                } catch (\Exception $e) {   
                    DB::rollBack();
  
                    return redirect()->route('client.books')->with('error', trans('requests.createfail'));
                } 
    
                    return redirect()->route('client.books')->with('success', trans('requests.createsuccess'));
            }
        } else {

            return redirect()->route('client.books')->with('error', trans('books.nobook'));
        }    

    }
}
