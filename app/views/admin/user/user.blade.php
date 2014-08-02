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
    @if ($user->isBanned())
        <p>This user is currently banned. Ban {{ $user->receivedBans()->get()->last()->isPermanent() ? 'is permanent.' : ' expires on '.$user->receivedBans()->get()->last()->end.'.' }} <a>Cancel</a> <a>Extend</a></p>
    @else
        <h4>Ban this user</h4>
        <div>
            {{ Form::open(array('action' => array('UserAdminController@postBan'))) }}
                @if(isset($errors))
                    <span class="error">{{ $errors->first() }}</span>
                @endif

                {{-- ID of banned player --}}
                {{ Form::hidden('user', $user->id) }}

                {{-- DAYS FIELD --}}
                {{ Form::label('length', 'Length') }}
                {{ Form::text('length', '3') }}

                {{-- COMMENT FIELD --}}
                {{ Form::label('comment', 'Comment') }}
                {{ Form::text('comment', null, array('placeholder' => 'Comment')) }}

                {{ Form::submit() }}
            {{ Form::close() }} 
        </div>
    @endif

    @if (count($user->receivedBans()->get()) == 0)
        <p>This user has received no bans.</p>
    @else
        <table>
            <tr>
                <th>Issued By</th>
                <th>Start</th>
                <th>Finish</th>
                <th>Validity</th>
                <th>Comment</th>
            </tr>
        @foreach ($user->receivedBans()->get() as $ban)
            <tr>
                <td>{{{ $ban->issuer->display_name }}}</td>
                <td>{{{ $ban->start }}}</td>
                <td>{{{ isset($ban->end) ? $ban->end : 'Permanent' }}}</td>
                <td>{{{ $ban->valid ? 'Valid' : 'Invalid' }}}</td>
                <td>{{{ $ban->comment }}}</td>
            </tr>
        @endforeach
        </table>
    @endif
@stop