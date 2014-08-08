@extends('templates.base')

@section('title')
    404
@stop

@section('body')
    <h1>404 Page Not Found</h1>
    <h4>Unfortunately this page couldn't be found. Please check your URL. <a href="{{ route('home') }}">Click here to return to home.</a></h4>
@stop