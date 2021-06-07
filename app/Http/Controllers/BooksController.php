<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;
use App\Models\Status;
use App\Models\Category;
use App\Models\Puplisher;
use App\Http\Requests\BooksRequest;
use DB;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = (new Book)->with('authors', 'status', 'puplisher', 'categories')->paginate(config('app.limit'));

        return view('admin.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::all();
        $statuses = Status::all();
        $puplishers = Puplisher::all();
        $categories = (new Category)->whereNull('parent_id')->get();

        return view('admin.books.create', compact('authors', 'statuses', 'categories', 'puplishers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BooksRequest $request)
    {
        $data = $request->all();
        $trans = DB::transaction(function () use ($request) {
            $book = Book::create([
                'name' => $request->name,
                'amount' => $request->amount,
                'status_id' => $request->status,
                'puplisher_id' => $request->puplisher,
                'thumbnail' => 'https://via.placeholder.com/118x180.png/007799?text=quo',
            ]);
            if($book){
                $book->authors()->attach($request->authors);
                $book->categories()->attach($request->categories);
            }

            return $book;
        });
        if($trans){

            return redirect()->route('books.index')->with('success', trans('books.successcreate')); 
        } else {

            return redirect()->route('books.index')->with('success', trans('books.failcreate')); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $authors = Author::all();
        $statuses = Status::all();
        $puplishers = Puplisher::all();
        $categories = (new Category)->whereNull('parent_id')->get();
        $book = Book::find($id);
        if($book){

            return view('admin.books.edit', compact('authors', 'statuses', 'categories', 'puplishers', 'book'));
        } else {

            return redirect()->route('books.index')->with('error', trans('books.noexitbook'));
        }    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BooksRequest $request, $id)
    {
        $data = $request->all();
        $book = Book::find($id);
        if($book){
            DB::beginTransaction();
            try {
                $book->name = $request->name;
                $book->amount = $request->amount;
                $book->status_id = $request->status;
                $book->puplisher_id = $request->puplisher;
                $book->thumbnail = 'https://via.placeholder.com/118x180.png/007799?text=quo';
                $book->save();
                $book->authors()->detach();
                $book->authors()->attach($request->authors);
                $book->categories()->detach();
                $book->categories()->attach($request->categories);

                DB::commit();
            } catch (\Exception $e) {   
                DB::rollBack();

                return redirect()->route('books.index')->with('error', trans('books.updatefail'));
            } 
                return redirect()->route('books.index')->with('success', trans('books.updatesuccess')); 
            
        }
        else {

            return redirect()->route('books.index')->with('error', trans('books.nobook')); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        if($book){
            DB::beginTransaction();
            try {
                $book->delete();
                $book->authors()->detach();
                $book->categories()->detach();

                DB::commit();
            } catch (\Exception $e) {   
                DB::rollBack();

                return redirect()->route('books.index')->with('error', trans('books.deletefail'));
            } 

                return redirect()->route('books.index')->with('success', trans('books.deletesuccess'));
            
        } else {

            return redirect()->route('books.index')->with('error', trans('books.noexitbook')); 
        }
    }
}
