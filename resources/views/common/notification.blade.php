@if (Session::has('error'))
    <!-- Form Error List -->
    <div class="alert alert-danger">
        <strong>{{ Session::get('error')}}</strong>
    </div>
@elseif (Session::has('success'))
    <div class="alert alert-success">  
        <strong>{{ Session::get('success')}}</strong>
    </div>
@endif
