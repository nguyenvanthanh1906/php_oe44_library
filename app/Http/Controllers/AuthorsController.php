<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Http\Requests\AuthorsRequest;
use App\Repositories\Authors\AuthorRepositoryInterface;

class AuthorsController extends Controller
{
    protected $authorRepo;

    public function __construct(AuthorRepositoryInterface $authorRepo)
    {
        $this->authorRepo = $authorRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $authors = (new Author)->where('delete_flag', false)->paginate(config('app.limit'));

        return view('authors.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('authors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\AuthorsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AuthorsRequest $request)
    {
        $data= $request->all();
        $author = Author::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        if ($author) {

            return redirect()->route('authors.index')->with('success', trans('authors.successcreate'));
        } else {
            
            return redirect()->route('authors.index')->with('error', trans('authors.failcreate'));
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
        $author = $this->authorRepo->getById($id);
        if ($author) {

            return view('authors.edit', compact('author'));
        } else {
            
            return redirect()->route('authors.index')->with('error', trans('authors.noexitauthor'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\AuthorsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AuthorsRequest $request, $id)
    {
        $data = $request->all();
        $author = $this->authorRepo->getById($id);

        if ($author) {
            $author->name = $data['name'];
            $author->description = $data['description'];
            $author->save();

            return redirect()->route('authors.index')->with('success', trans('authors.updatesuccess'));
        } else {

            return redirect()->route('authors.index')->with('error', trans('authors.noexitauthor'));
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
        $author = $this->authorRepo->getById($id);
        if ($author) {
            $author->delete_flag = true;
            $author->save();

            return redirect()->route('authors.index')->with('success', trans('authors.deletesuccess'));
        } else {

            return redirect()->route('authors.index')->with('error', trans('authors.noexitauthor'));
        }
    }
}
