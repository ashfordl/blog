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

    <h3>Bans</h3>
    @if (count($user->receivedBans()->get()) == 0)
        <p>This user has received no bans.</p>
    @else
        <table>
            <tr>
                <th>Issued By</th>
                <th>Start</th>
                <th>Finish</th>
                <th>Validity</th>
                <th>Type</th>
                <th>Comment</th>
            </tr>
        @foreach ($user->receivedBans()->get() as $ban)
            <tr>
                <td>{{{ $ban->issuer->display_name }}}</td>
                <td>{{{ $ban->start }}}</td>
                <td>{{{ $ban->end }}}</td>
                <td>{{{ $ban->valid ? 'Valid' : 'Invalid' }}}</td>
                <td>{{{ $ban->type->name }}}</td>
                <td>{{{ $ban->comment }}}</td>
            </tr>
        @endforeach
        </table>
    @endif
    
@stop