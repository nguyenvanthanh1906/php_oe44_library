@extends('admin.layouts.app', ['page' => 'requests'])

@section('content')
    <div class="container">
        @include('common.notification')
        <h2>{{ trans('requests.list') }}</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>{{ trans('books.thumbnail') }}</th>
                    <th>{{ trans('books.name') }}</th>
                    <th>{{ trans('users.name') }}</th>
                    <th>{{ trans('requests.borrowday') }}</th>
                    <th>{{ trans('requests.payday') }}</th>
                    <th>{{ trans('requests.isapprove') }}</th>
                    <th>{{ trans('books.action') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><img src="/cimg/{{$request->book->thumbnail}}" alt=""></td>
                    <td>{{$request->book->name}}</td>
                    <td>{{$request->user->name}}</td>
                    <td>{{$request->borrow_day}}</td>
                    <td>{{$request->return_day}}</td>
                    @if($request->is_approve)
                        <td><img src="{{asset('img/check.png')}}" alt=""></td>
                    @else
                        <td><img src="{{asset('img/crossed.png')}}" alt=""></td>
                    @endif
                    <td>
                        @if($request->is_approve)
                            
                        @else
                            <a href="{{Route('accept.request', [$request->id])}}" class="btn btn-success">{{ trans('requests.accept') }}</a>
                        @endif
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal{{$request->id}}">{{ trans('requests.delete') }}</button>
                        <div class="modal" id="myModal{{$request->id}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        {{ trans('common.sure') }}
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{Route('requests.destroy', ['request' => $request->id])}}" method="post">
                                            {{ csrf_field() }}
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">{{ trans('requests.delete') }}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
