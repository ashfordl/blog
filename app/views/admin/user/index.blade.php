@extends('templates.base')

@section('title')
    User Admin
@stop

@section('body')
    <h1>User Admin</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Display Name</th>
            <th>E-Mail</th>
            <th>Created At</th>
        </tr>
    @foreach($users as $user)
        <tr>
            <td>{{{ $user->id }}}</td>
            <td><a href="{{ action('UserAdminController@getUser', $user->id) }}">{{{ $user->display_name }}}</a></td>
            <td>{{{ $user->email }}}</td>
            <td>{{{ $user->created_at }}}</td>
        </tr>
    @endforeach
    </table>
@stop