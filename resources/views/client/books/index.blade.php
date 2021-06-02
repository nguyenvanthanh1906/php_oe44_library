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
                            <h6 class="card-title">{{$book->name}}</h6>
                            @if($book->amount > 0)
                                <a href="/request/create/{{$book->id}}" class="btn btn-primary">Borrow</a>
                            @else
                                <p class="no-book">{{trans('books.nobook')}}</p>
                            @endif
                        </div>
                    </div>
                </div>   
            @endforeach       
        </div>
        {{$books->links()}}
    </div>
@endsection    
