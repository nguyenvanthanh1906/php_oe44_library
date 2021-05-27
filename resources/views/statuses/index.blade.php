@extends('layouts.app', ['page' => 'statuses'])

@section('content')
    <div class="container">
        @include('common.notification')
        <h2>{{ trans('statuses.statuseslist') }}</h2>
        <a href="{{Route('statuses.create')}}" class="btn btn-primary float-right">{{ trans('statuses.newstatus')}}</a>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ trans('statuses.name') }}</th>
                    <th>{{ trans('statuses.action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($statuses as $key=>$status)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$status->name}}</td>
                    <td>
                        <a href="{{route('statuses.edit', ['status' => $status->id,])}}" class="btn btn-success">{{ trans('common.edit') }}</a>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal{{$status->id}}">{{ trans('common.delete') }}</button>
                        <div class="modal" id="myModal{{$status->id}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        {{ trans('common.sure') }}
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{route('statuses.destroy', ['status' => $status->id],)}}" method="post">
                                            {{ csrf_field() }}
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">{{ trans('common.delete') }}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
            {{$statuses->links()}}
    </div>
@endsection
