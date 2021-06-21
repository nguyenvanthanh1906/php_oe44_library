@extends('admin.layouts.app', ['page' => 'home'])
@section('content')
<div class="container">
    <center><h1>{{ trans('requests.weeklystatistics')}}</h1></center>
    <label for="weeks">{{trans('requests.week')}}</label>
    <select name="weeks" class="form-control w-25" id="weeks">
        @for ($i = 0; $i <= config('app.limit_chart'); $i++)
            <option value="{{ date('W') - $i}}" >{{ date('W') - $i}}</option>
        @endfor
    </select>
    <canvas id="myChart" ></canvas>
    <br>
    <center><h1>{{ trans('requests.monthlystatistics')}}</h1></center>
    <label for="weeks">{{trans('requests.month')}}</label>
    <select name="months" class="form-control w-25" id="months">
        @for ($i = 0; $i <= config('app.limit_chart'); $i++)
            <option value="{{ date('m') - $i}}" >{{ date('m') - $i}}</option>
        @endfor
    </select>
    <canvas id="myChartMonth" ></canvas>
    @csrf
</div>  
@endsection
