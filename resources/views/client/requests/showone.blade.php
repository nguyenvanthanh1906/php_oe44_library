@extends('client.layouts.app')

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
                </tr>
            </tbody>
        </table>
    </div>
@endsection
