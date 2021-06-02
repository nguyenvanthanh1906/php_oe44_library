<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CRequest;

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

    public function destroy(Request $request, $id)
    {
        $crequest = (new CRequest)->withTrashed()->where('id', $id)->first();
        if ($crequest) {
            $crequest->delete();

            return redirect()->route('requests.all', ['isApprove' => $request->isApprove])->with('success', trans('requests.deletesuccess'));
        } else {

            return redirect()->route('requests.all', ['isApprove' => $request->isApprove])->with('error', trans('requests.noexit'));
        }
    }

    public function accept($id)
    {
        $request = (new CRequest)->withTrashed()->where('id', $id)->first();

        if($request)
        {
            $request->is_approve = true;
            $request->save();
            
            return redirect()->back();
        } else {

            return redirect()->route('requests.index')->with('success', trans('requests.noexit'));
        }
    }
}
