<div class="sidebar">
  <a  href="./">Home</a>
  <a class="@if($page == 'authors') active @endif" href="{{route('authors.index', ['locale' => Request::segment(1)])}}">Authors</a>
  <a class="@if($page == 'books') active @endif" href="{{route('books.index')}}">Books</a>
</div>
