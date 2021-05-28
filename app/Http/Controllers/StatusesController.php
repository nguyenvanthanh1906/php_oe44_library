<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
use App\Http\Requests\StatusesRequest;
use App\Repositories\Statuses\StatusRepositoryInterface;

class StatusesController extends Controller
{
    protected $statusRepo;
    public function __construct(StatusRepositoryInterface $statusRepo)
    {
        $this->statusRepo = $statusRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses = (new Status)->where('delete_flag', false)->paginate(config('app.limit'));

        return view('admin.statuses.index', compact('statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.statuses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StatusesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StatusesRequest $request)
    {
        $data = $request->all();
        $status = Status::create([
            'name' => $request->name,
        ]);
        if ($status) {

            return redirect()->route('statuses.index')->with('success', trans('statuses.successcreate'));
        } else {
            
            return redirect()->route('statuses.index')->with('error', trans('statuses.failcreate'));
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
        $status = $this->statusRepo->getById($id);
        if ($status ) {

            return view('admin.statuses.edit', compact('status'));
        } else {
            
            return redirect()->route('statuses.index')->with('error', trans('statuses.noexitstatus'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $status = $this->statusRepo->getById($id);

        if ($status) {
            $status->name = $data['name'];
            $status->save();

            return redirect()->route('statuses.index')->with('success', trans('statuses.updatesuccess'));
        } else {

            return redirect()->route('statuses.index')->with('error', trans('statuses.noexitstatus'));
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
        $status = $this->statusRepo->getById($id);
        if ($status) {
            $status->delete_flag = true;
            $status->save();

            return redirect()->route('statuses.index')->with('success', trans('statuses.deletesuccess'));
        } else {

            return redirect()->route('statuses.index')->with('error', trans('statuses.noexitstatus'));
        }
    }
}
