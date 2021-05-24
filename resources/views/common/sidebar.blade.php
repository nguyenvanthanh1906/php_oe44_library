<div class="sidebar">
  <a  href="./">Home</a>
  <a class="@if($page == 'authors') active @endif" href="{{route('authors.index', ['locale' => Request::segment(1)])}}">Authors</a>
</div>
