<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="{{asset('js/jquery.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/gijgo.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/app.js')}}" type="text/javascript"></script>
    <link rel="stylesheet" href="{{asset('css/app.css')}}"/>
    <link href="{{asset('css/gijgo.css')}}" rel="stylesheet" type="text/css" />
    <title>Library</title>
</head>
<body>
    @include('common.language')
    @yield('content')
    <script src="{{asset('js/datepicker.js')}}" type="text/javascript"></script>
</body>
</html>
