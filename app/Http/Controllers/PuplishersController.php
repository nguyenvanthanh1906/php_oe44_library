<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Puplisher;
use App\Http\Requests\PuplishersRequest;
use App\Repositories\Puplishers\PuplisherRepositoryInterface;

class PuplishersController extends Controller
{
    protected $puplisherRepo;

    public function __construct(PuplisherRepositoryInterface $puplisherRepo)
    {
        $this->puplisherRepo = $puplisherRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $puplishers = (new Puplisher)->where('delete_flag', false)->paginate(config('app.limit'));

        return view('puplishers.index', compact('puplishers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('puplishers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\PuplishersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PuplishersRequest $request)
    {
        $data = $request->all();
        $puplisher = Puplisher::create([
            'name' => $request->name,
        ]);
        if ($puplisher) {

            return redirect()->route('puplishers.index')->with('success', trans('puplishers.successcreate'));
        } else {
            
            return redirect()->route('puplishers.index')->with('error', trans('puplishers.failcreate'));
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
        $puplisher = $this->puplisherRepo->getById($id);
        if ($puplisher) {

            return view('puplishers.edit', compact('puplisher'));
        } else {
            
            return redirect()->route('puplishers.index')->with('error', trans('puplishers.noexitpuplisher'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\PuplishersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PuplishersRequest $request, $id)
    {
        $data = $request->all();
        $puplisher = $this->puplisherRepo->getById($id);

        if ($puplisher) {
            $puplisher->name = $data['name'];
            $puplisher->save();

            return redirect()->route('puplishers.index')->with('success', trans('puplishers.updatesuccess'));
        } else {

            return redirect()->route('puplishers.index')->with('error', trans('puplishers.noexitpuplisher'));
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
        $puplisher = $this->puplisherRepo->getById($id);
        if ($puplisher) {
            $puplisher->delete_flag = true;
            $puplisher->save();

            return redirect()->route('puplishers.index')->with('success', trans('puplishers.deletesuccess'));
        } else {

            return redirect()->route('puplishers.index')->with('error', trans('puplishers.noexitpuplisher'));
        }
    }
}
