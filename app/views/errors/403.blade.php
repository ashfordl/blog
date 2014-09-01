@extends('templates.base')

@section('title')
    403
@stop

@section('body')
<div class="row"><div class="col-xs-12">
    <h1>403 Access Denied</h1>
    <h4>You do not have permission to access this page. <a href="{{ route('home') }}">Click here to return to home.</a></h4>
</div></div>
@stop