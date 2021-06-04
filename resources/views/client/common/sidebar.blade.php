<div class="sidebar">
    <a href="/all-books/all" class="adrop">All</a>
    @foreach($categories as $category)
        @if($category->parent_id == null)
        <div class="dropdown">
            <a class="adrop" href="/all-books/{{$category->name}}">{{$category->name}}</a>
            <div class="dropdown-content">
                @foreach($category->childrent as $child)
                    <a href="/all-books/{{$child->name}}">{{$child->name}}</a>
                @endforeach
            </div>
          </div>
        @endif    
    @endforeach
</div>
  