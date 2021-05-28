<?php

namespace App\Http\Controllers\client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Book;

class CRequestsController extends Controller
{
    public function create(Request $request)
    {
        $book = (new Book)->find($request->book);
        
        return view('client.requests.create', compact('book'));
    }
}
