<div class="sidebar">
  <a  href="./">Home</a>
  <a class="@if($page == 'authors') active @endif" href="{{route('authors.index')}}">Authors</a>
  <a class="@if($page == 'puplishers') active @endif" href="{{route('puplishers.index')}}">Puplishers</a>
</div>
