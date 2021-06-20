@extends('admin.layouts.app', ['page' => 'puplishers'])

@section('content')
    <div class="container main">
        <h2>{{ trans('puplishers.addpuplisher') }}</h2>
        <form action="{{ Route('puplishers.store') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="task" class="col-sm-3 control-label">{{ trans('puplishers.name')}}</label>
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
                        <i class="fa fa-plus"></i> {{ trans('puplishers.addpuplisher')}}
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
