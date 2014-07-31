@extends('templates.base')

@section('title')
    User Admin
@stop

@section('body')
    <h1>User Admin - {{{ $user->display_name }}}</h1>
    <h3>Info</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Display Name</th>
            <th>E-Mail</th>
            <th>Created At</th>
        </tr>
        <tr>
            <td>{{{ $user->id }}}</td>
            <td>{{{ $user->display_name }}}</td>
            <td>{{{ $user->email }}}</td>
            <td>{{{ $user->created_at }}}</td>
        </tr>
    </table>
@stop