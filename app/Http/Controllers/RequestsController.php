<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CRequest;
use App\Notifications\CRequestNotification;
use Pusher\Pusher;
use Illuminate\Support\Facades\Auth;

class RequestsController extends Controller
{
    
    public function all($isApprove)
    {
        if($isApprove != 'both')
        {
            $requests = (new CRequest)->where('is_approve', $isApprove)->paginate(config('app.limit'));
        } else {
            $requests = (new CRequest)->paginate(config('app.limit'));
        }
          
        return view('admin.requests.index', compact('requests', 'isApprove'));
    }

    public function showone($id)
    {
        $crequest = Crequest::find($id);
        if ($crequest) {

            return view('admin.requests.showone', ['request' => $crequest]);
        } else {
            
            return redirect()->back()->with('error', trans('requests.noexit'));
        }
    }

    public function destroy(Request $request, $id)
    {
        $crequest = Crequest::find($id);
        if ($crequest) {
            $crequest->delete();

            return redirect()->route('requests.all', ['isApprove' => $request->isApprove])->with('success', trans('requests.deletesuccess'));
        } else {

            return redirect()->route('requests.all', ['isApprove' => $request->isApprove])->with('error', trans('requests.noexit'));
        }
    }

    public function accept($id)
    {
        $request = Crequest::find($id);

        if($request)
        {
            $request->is_approve = true;
            $request->save();

            $user = $request->user; 
            $data = ['book' => $request->book->name, 'title' => 'Accepted', 'user' => Auth::user()->name, 'link' => route('request.showone', [$request->id])];
            $user->notify(new CRequestNotification($data));
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
    
            $pusher->trigger('NotificationEvent', 'send-message-client', $data);
            
            return redirect()->back();
        } else {

            return redirect()->route('requests.index')->with('success', trans('requests.noexit'));
        }
    }
}
