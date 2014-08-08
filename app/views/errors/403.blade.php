@extends('templates.base')

@section('title')
    403
@stop

@section('body')
    <h1>403 Access Denied</h1>
    <h4>You do not have permission to access this page. <a href="{{ route('home') }}">Click here to return to home.</a></h4>
@stop