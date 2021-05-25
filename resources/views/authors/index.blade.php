@extends('layouts.app', ['page' => 'authors'])

@section('content')
  <div class="container">
      @include('common.notification')
      <h2>{{ trans('authors.authorslist') }}</h2>
      <a href="{{Route('authors.create')}}" class="btn btn-primary float-right">{{ trans('authors.newauthor')}}</a>
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>{{ trans('authors.name') }}</th>
            <th>{{ trans('authors.action') }}</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($authors as $key=>$author)
          <tr>
            <td>{{$key + 1}}</td>
            <td>{{$author->name}}</td>
            <td>
              <a href="{{route('authors.edit', ['author' => $author->id,])}}" class="btn btn-success">{{ trans('common.edit') }}</a>
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal{{$author->id}}">{{ trans('common.delete') }}</button>
              <div class="modal" id="myModal{{$author->id}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-body">
                      {{ trans('common.sure') }}
                    </div>
                    <div class="modal-footer">
                      <form action="{{route('authors.destroy', ['author' => $author->id],)}}" method="post">
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
      {{$authors->links()}}
    </div>
@endsection
