<div class="sidebar">
  <a class="@if($page == 'home') active @endif" href="{{route('charts.index')}}">Home</a>
  <a class="@if($page == 'books') active @endif" href="{{route('books.index')}}">Books</a>
  <a class="@if($page == 'authors') active @endif" href="{{route('authors.index')}}">Authors</a>
  <a class="@if($page == 'puplishers') active @endif" href="{{route('puplishers.index')}}">Puplishers</a>
  <a class="@if($page == 'statuses') active @endif" href="{{route('statuses.index')}}">Statuses</a>
  <a class=" dropdown-toggle @if($page == 'requests') active-pointer @endif" data-toggle="dropdown" href="">Requests</a>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="{{route('requests.all', ['isApprove' => 'both'])}}">All</a>
    <a class="dropdown-item" href="{{route('requests.all', ['isApprove' => 0])}}">Not Accepted</a>
    <a class="dropdown-item" href="{{route('requests.all', ['isApprove' => 1])}}">Accepted</a>
  </div>
</div>
