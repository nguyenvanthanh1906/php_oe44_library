@extends('client.layouts.app')

@section('content')  
    <div class="container">
        @include('common.notification')
        <h2>{{ trans('request.create') }}</h2>
        <form action="{{route('request.store')}}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            <div class="form-group">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-2">
                            <img src="{{$book->thumbnail}}" alt="">
                        </div>
                        <div class="col-sm-10">
                            <h4>{{trans('request.bookname')}} : </h4><p>{{$book->name}}</p>
                            <h4>{{trans('books.authors')}} : </h4>
                            @foreach($book->authors as $author)
                                <p>{{$author->name}}</p>
                            @endforeach
                        </div> 
                    </div>
                    <input type="hidden" name="book" id="task-name" class="form-control" value="{{$book->id}}">
                </div>
            </div>
            <div class="form-group">
                <div class="form-group">
                    <label for="task" class="col-sm-3 control-label">{{ trans('request.borrowday')}}</label>
                    <input id="datepickerborrow" name="borrowday" type="date"/>
                    @error('borrowday')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="form-group">
                    <label for="task" class="col-sm-3 control-label">{{ trans('request.returnday')}}</label>
                    <input id="datepickerpay" name="returnday" type="date" />
                    @error('returnday')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-plus"></i> {{ trans('request.create')}}
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection    
