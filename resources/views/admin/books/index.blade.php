@extends('admin.layouts.app', ['page' => 'books'])
@section('content')
    <div class="container">
        @include('common.notification')
        <h2>{{ trans('books.bookslist') }}</h2>
        <a href="{{Route('books.create')}}" class="btn btn-primary float-right">{{ trans('books.newbook')}}</a>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ trans('books.thumbnail') }}</th>
                    <th>{{ trans('books.name') }}</th>
                    <th>{{ trans('books.amount') }}</th>
                    <th>{{ trans('books.status') }}</th>
                    <th>{{ trans('books.categories')}}</th>
                    <th>{{ trans('books.puplisher') }}</th>
                    <th>{{ trans('books.authors') }}</th>
                    <th>{{ trans('books.action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $key=>$book)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td><img src="/cimg/{{$book->thumbnail}}" alt=""></td>
                    <td>{{$book->name}}</td>
                    <td>{{$book->amount}}</td>
                    <td>{{$book->status->name}}</td>
                    <td>
                        @foreach($book->categories as $cate)
                            <p>{{$cate->name}}</p>
                        @endforeach
                    </td>    
                    <td>{{$book->puplisher->name}}</td>
                    <td>
                        @foreach($book->authors as $author)
                            <p>{{$author->name}}</p>
                        @endforeach
                    </td>    
                    <td>
                        <a href="{{route('books.edit', ['book' => $book->id,])}}" class="btn btn-success">{{ trans('common.edit') }}</a>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal{{$book->id}}">{{ trans('common.delete') }}</button>
                        <div class="modal" id="myModal{{$book->id}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        {{ trans('common.sure') }}
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{route('books.destroy', ['book' => $book->id],)}}" method="post">
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
            {{$books->links()}}
    </div>
@endsection
