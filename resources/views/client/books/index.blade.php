@extends('client.layouts.app', ['page' => 'puplishers'])

@section('content')  
    <div class="container">
        @include('common.notification')
        <h2>{{ trans('books.bookslist') }}</h2>
        <div class="row">
            @foreach($books as $book)
                <div class="col-lg-2 ">
                    <div class="card" >
                        <img class="card-img-top" src="{{$book->thumbnail}}" alt="Card image" >
                        <div class="card-body">
                            <h4 class="card-title">{{$book->name}}</h4>
                            <p class="card-text">{{$book->author}}</p>
                            <a href="#" class="btn btn-primary stretched-link">Borrow</a>
                        </div>
                    </div>
                </div>   
            @endforeach       
        </div>
        {{$books->links()}}
    </div>
@endsection    
