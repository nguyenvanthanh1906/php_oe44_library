@extends('admin.layouts.app', ['page' => 'books'])

@section('content')
    <div class="container">
        <h2>{{ trans('books.addbook') }}</h2>
        <form action="{{ Route('books.store') }}" method="POST" class="form-horizontal" enctype='multipart/form-data'>
            {{ csrf_field() }}
            <div class="form-group">
                <label for="thumbnail" class="col-sm-3 control-label">{{ trans('books.thumbnail')}}</label>
                <div class="col-sm-6">
                    <input type="file" name="thumbnail" id="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror">
                    <img id="imgThumbnail" src="" alt="Thumbnail" />
                    @error('thumbnail')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="task" class="col-sm-3 control-label">{{ trans('books.name')}}</label>
                <div class="col-sm-6">
                    <input type="text" name="name" id="task-name" class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="task" class="col-sm-3 control-label">{{ trans('books.amount')}}</label>
                <div class="col-sm-6">
                    <input type="text" name="amount" id="task-name" class="form-control @error('amount') is-invalid @enderror">
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
                            <option value="{{$author->id}}">{{$author->name}}</option>
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
                            <option value="{{$puplisher->id}}">{{$puplisher->name}}</option>
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
                            <option value="{{$status->id}}">{{$status->name}}</option>
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
                                    <option  value="{{$child->id}}">{{$child->name}}</option>
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
                        <i class="fa fa-plus"></i> {{ trans('books.addbook')}}
                    </button>
                </div>
            </div>
        </form>
    </div>
    <script src="{{asset('js/thumbnail.js')}}"></script>
@endsection
