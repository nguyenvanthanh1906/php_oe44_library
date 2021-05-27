<div class="sidebar">
  <a  href="./">Home</a>
  <a class="@if($page == 'authors') active @endif" href="{{route('authors.index', ['locale' => Request::segment(1)])}}">Authors</a>
  <a class="@if($page == 'statuses') active @endif" href="{{route('statuses.index')}}">Statuses</a>
</div>
