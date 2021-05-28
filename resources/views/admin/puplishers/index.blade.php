@extends('admin.layouts.app', ['page' => 'puplishers'])

@section('content')
    <div class="container">
        @include('common.notification')
        <h2>{{ trans('puplishers.puplisherslist') }}</h2>
        <a href="{{Route('puplishers.create')}}" class="btn btn-primary float-right">{{ trans('puplishers.newpuplisher')}}</a>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ trans('puplishers.name') }}</th>
                    <th>{{ trans('puplishers.action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($puplishers as $key=>$puplisher)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$puplisher->name}}</td>
                    <td>
                        <a href="{{route('puplishers.edit', ['puplisher' => $puplisher->id,])}}" class="btn btn-success">{{ trans('common.edit') }}</a>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal{{$puplisher->id}}">{{ trans('common.delete') }}</button>
                        <div class="modal" id="myModal{{$puplisher->id}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        {{ trans('common.sure') }}
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{route('puplishers.destroy', ['puplisher' => $puplisher->id],)}}" method="post">
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
        {{$puplishers->links()}}
    </div>
@endsection
