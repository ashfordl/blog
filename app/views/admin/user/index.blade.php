@extends('templates.base')

@section('title')
    User Admin
@stop

@section('body')
    <h1>User Admin</h1>

    <h4>Users</h4>
    <div class="col-md-8 col-lg-6">
        <table class="table table-hover">
            <tr>
                <th>ID</th>
                <th>Display Name <small>Click to view</small></th>
                <th>Email</th>
                <th>Created At</th>
                <th>Ban Status</th>
            </tr>
        @foreach($users as $user)
            <tr>
                <td>{{{ $user->id }}}</td>
                <td><a href="{{ action('UserAdminController@getView', $user->id) }}">{{{ $user->display_name }}}</a></td>
                <td>{{{ $user->email }}}</td>
                <td>{{{ $user->created_at }}}</td>
                <td>@if ($user->isBanned())
                    Banned
                @endif </td>
            </tr>
        @endforeach
        </table>
    </div>
@stop