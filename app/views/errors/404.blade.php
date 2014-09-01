@extends('templates.base')

@section('title')
    404
@stop

@section('body')
<div class="row"><div class="col-xs-12">
    <h1>404 Page Not Found</h1>
    <h4>Unfortunately this page couldn't be found. Please check your URL. <a href="{{ route('home') }}">Click here to return to home.</a></h4>
</div></div>
@stop