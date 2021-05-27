@extends('layouts.app', ['page' => 'statuses'])

@section('content')
    <div class="container">
        <h2>{{ trans('statuses.addstatuse') }}</h2>
        <form action="{{ Route('statuses.update', ['status' => $status->id,]) }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            @method('PUT')
            <div class="form-group">
                <label for="task" class="col-sm-3 control-label">{{ trans('statuses.name')}}</label>
                <div class="col-sm-6">
                    <input type="text" name="name" id="task-name" class="form-control @error('name') is-invalid @enderror" value="{{$status->name}}">
                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-plus"></i> {{ trans('common.edit')}}
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
