<?php

namespace App\Http\Controllers\client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Book;

class CBooksController extends Controller
{
    public function index()
    {   
        $books = (new Book)->paginate(config('app.limit'));

        return view('client.books.index', compact('books'));
    }
}
