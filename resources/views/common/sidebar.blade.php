<div class="sidebar sidebar-admin">
    <a class="@if($page == 'home') active @endif" href="/admin/charts">
        <img src="{{asset('img/house.png')}}" alt="">
        Home
    </a>
    <a class="@if($page == 'books') active @endif" href="{{route('books.index')}}">
        <img src="{{asset('img/book.png')}}" alt="">
        Books
    </a>
    <a class="@if($page == 'authors') active @endif" href="{{route('authors.index')}}">
        <img src="{{asset('img/writer.png')}}" alt="">
        Authors
    </a>
    <a class="@if($page == 'categories') active @endif" href="#">
      <img src="{{asset('img/options.png')}}" alt="">
      Categories
  </a>
    <a class="@if($page == 'puplishers') active @endif" href="{{route('puplishers.index')}}">
        <img src="{{asset('img/warehouse.png')}}" alt="">  
        Puplishers
    </a>
    <a class="@if($page == 'statuses') active @endif" href="{{route('statuses.index')}}">
        <img src="{{asset('img/battery-level.png')}}" alt="">
        Statuses
    </a>
    <a class=" dropdown-toggle @if($page == 'requests') active-pointer @endif" data-toggle="dropdown" href="">
        <img src="{{asset('img/application.png')}}" alt="">
        Requests</a>
    <div class="dropdown-menu-sidebar dropdown-menu">
      <a class="dropdown-item dropdown-item-sidebar" href="{{route('requests.all', ['isApprove' => 'both'])}}">All requests</a>
      <a class="dropdown-item dropdown-item-sidebar" href="{{route('requests.all', ['isApprove' => 0])}}">Not Accepted</a>
      <a class="dropdown-item dropdown-item-sidebar" href="{{route('requests.all', ['isApprove' => 1])}}">Accepted</a>
    </div>
</div>
  