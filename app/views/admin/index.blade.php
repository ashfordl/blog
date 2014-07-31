@extends('templates.base')

@section('title')
    Admin
@stop

@section('body')
    <h1>Admin Dashboard</h1>

    <ul>
    <li><a href="{{ action('BlogAdminController@getIndex') }}">Blog</a></li>
    <li><a href="{{ action('UserAdminController@getIndex') }}">User</a></li>
    </ul>
@stop