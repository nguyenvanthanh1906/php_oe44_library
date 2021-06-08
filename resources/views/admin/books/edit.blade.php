@extends('admin.layouts.app', ['page' => 'books'])

@section('content')
    <div class="container">
        <h2>{{ trans('books.addbook') }}</h2>
        <form action="{{ Route('books.update', ['book' => $book->id]) }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            @method('PUT')
            <div class="form-group">
                <label for="thumbnail" class="col-sm-3 control-label">{{ trans('books.thumbnail')}}</label>
                <div class="col-sm-6">
                    <input type="file" name="thumbnail" id="thumbnail" value="{{$book->thumbnail}}" class="form-control @error('thumbnail') is-invalid @enderror">
                    <img id="imgThumbnail" src="{{$book->thumbnail}}" alt="Thumbnail" />
                    @error('thumbnail')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="task" class="col-sm-3 control-label">{{ trans('books.name')}}</label>
                <div class="col-sm-6">
                    <input type="text" name="name" id="task-name" value="{{$book->name}}" class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="task" class="col-sm-3 control-label">{{ trans('books.amount')}}</label>
                <div class="col-sm-6">
                    <input type="text" name="amount" id="task-name" value="{{$book->amount}}" class="form-control @error('amount') is-invalid @enderror">
                    @error('amount')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="task" class="col-sm-3 control-label">{{ trans('books.authors')}}</label>
                <div class="col-sm-6">
                    <select name="authors[]" class="js-example-basic-single form-control @error('authors') is-invalid @enderror" id="authors" multiple="multiple">
                        @foreach($authors as $author)
                            @if($book->authors->contains('name', $author->name))
                                <option value="{{$author->id}}" selected>{{$author->name}}</option>
                            @else    
                                <option value="{{$author->id}}" >{{$author->name}}</option>
                            @endif
                        @endforeach 
                    </select>            
                    @error('authors')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="task" class="col-sm-3 control-label">{{ trans('books.puplisher')}}</label>
                <div class="col-sm-6">
                    <select name="puplisher" class="form-control @error('puplisher') is-invalid @enderror" id="puplisher" >
                            <option value="">Null</option>
                        @foreach($puplishers as $puplisher)
                            @if($book->puplisher == $puplisher)
                                <option value="{{$puplisher->id}}" selected>{{$puplisher->name}}</option>
                            @else 
                                <option value="{{$puplisher->id}}" >{{$puplisher->name}}</option>
                            @endif
                        @endforeach 
                    </select>            
                    @error('puplisher')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="task" class="col-sm-3 control-label">{{ trans('books.status')}}</label>
                <div class="col-sm-6">
                    <select name="status" class="form-control @error('status') is-invalid @enderror" id="status" >
                            <option value="">Null</option>
                        @foreach($statuses as $status)
                            @if($book->status == $status)
                                <option value="{{$status->id}}" selected>{{$status->name}}</option>
                            @else    
                                <option value="{{$status->id}}">{{$status->name}}</option>
                            @endif
                        @endforeach 
                    </select>            
                    @error('status')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="task" class="col-sm-3 control-label">{{ trans('books.categories')}}</label>
                <div class="col-sm-6">
                    <select name="categories[]" class="js-example-basic-single form-control @error('categories') is-invalid @enderror" id="categories" multiple="multiple">
                        @foreach($categories as $cate)
                            <optgroup label="{{$cate->name}}">
                                @foreach($cate->childrent as $child)
                                    @if($book->categories->contains('name', $child->name))
                                        <option value="{{$child->id}}" selected>{{$child->name}}</option>
                                    @else    
                                        <option value="{{$child->id}}" >{{$child->name}}</option>
                                    @endif
                                @endforeach
                            </optgroup>
                        @endforeach 
                    </select>            
                    @error('categories')
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
    <script src="{{asset('js/thumbnail.js')}}"></script>
@endsection
