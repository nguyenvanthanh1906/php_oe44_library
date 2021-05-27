@extends('layouts.app', ['page' => 'authors'])

@section('content')
    <div class="container">
        <h2>{{ trans('authors.addauthor') }}</h2>
        <form action="{{ Route('authors.update', ['author' => $author->id,]) }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            @method('PUT')
            <div class="form-group">
                <label for="task" class="col-sm-3 control-label">{{ trans('authors.name')}}</label>
                <div class="col-sm-6">
                    <input type="text" name="name" id="task-name" class="form-control @error('name') is-invalid @enderror" value="{{$author->name}}">
                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="task" class="col-sm-3 control-label">{{ trans('authors.description')}}</label>
                <div class="col-sm-6">
                    <textarea type="text" name="description" id="task-description" class="form-control @error('description') is-invalid @enderror" >{{$author->description}}</textarea>
                    @error('description')
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
