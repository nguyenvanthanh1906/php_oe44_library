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
        $books = Book::with('authors', 'status', 'puplisher', 'categories')->paginate(config('app.limit'));

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
        $categories = Category::whereNull('parent_id')->get();

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
        $thumbnail=$request->thumbnail;
        $thumbnail_name=$thumbnail->getClientOriginalName();
        $thumbnail->move('cimg',$thumbnail_name);
        DB::beginTransaction();
        try {
            $book = Book::create([
                'name' => $request->name,
                'amount' => $request->amount,
                'status_id' => $request->status,
                'puplisher_id' => $request->puplisher,
                'thumbnail' => $thumbnail_name,
            ]);
            

            DB::commit();
        } catch (\Exception $e) {   
            DB::rollBack();

            return redirect()->route('books.index')->with('error', trans('books.failcreate')); 
        } 

        return redirect()->route('books.index')->with('success', trans('books.successcreate'));  
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
        $categories = Category::whereNull('parent_id')->get();
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
            if($request->thumbnail){
                $thumbnail=$request->thumbnail;
                $thumbnail_name=$thumbnail->getClientOriginalName();
                $thumbnail->move('cimg',$thumbnail_name);
                DB::beginTransaction();
                try {
                    $book->name = $request->name;
                    $book->amount = $request->amount;
                    $book->status_id = $request->status;
                    $book->puplisher_id = $request->puplisher;
                    $book->thumbnail = $thumbnail_name;
                    $book->save();
                    
                    $book->authors()->sync($request->authors);
                    $book->categories()->sync($request->categories);

                    DB::commit();
                } catch (\Exception $e) {   
                    DB::rollBack();

                    return redirect()->route('books.index')->with('error', trans('books.updatefail'));
                } 

                    return redirect()->route('books.index')->with('success', trans('books.updatesuccess')); 
            } else {
                DB::beginTransaction();
                try {
                    $book->name = $request->name;
                    $book->amount = $request->amount;
                    $book->status_id = $request->status;
                    $book->puplisher_id = $request->puplisher;
                    $book->save();
                    
                    $book->authors()->sync($request->authors);
                    $book->categories()->sync($request->categories);

                    DB::commit();
                } catch (\Exception $e) {   
                    DB::rollBack();

                    return redirect()->route('books.index')->with('error', trans('books.updatefail'));
                } 

                    return redirect()->route('books.index')->with('success', trans('books.updatesuccess')); 
            }
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
