@extends('admin.layouts.app', ['page' => 'statuses'])

@section('content')
    <div class="container">
        <h2>{{ trans('statuses.addstatus') }}</h2>
        <form action="{{ Route('statuses.store') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="task" class="col-sm-3 control-label">{{ trans('statuses.name')}}</label>
                <div class="col-sm-6">
                    <input type="text" name="name" id="task-name" class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-plus"></i> {{ trans('statuses.addstatus')}}
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
