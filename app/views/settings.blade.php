@extends('templates.base')

@section('title')
    Settings | Blog
@stop

@section('body')
    <h3>Settings</h3>
    {{ Form::open(array('action' => 'UserController@postSettings')) }}

        {{-- SUCCESSES --}}
        @foreach($successes as $success)
            <span class="success">{{ $success }}</span>
        @endforeach

        {{-- ERRORS --}}
        @foreach($errors as $error)
            <span class="error">{{ $error }}</span>
        @endforeach

        {{-- EMAIL FIELD --}}
        {{ Form::label('email', 'E-Mail') }}
        {{ Form::text('email', $user->email, array('disabled')) }}

        {{-- NAME FIELD --}}
        {{ Form::label('name', 'Display Name') }}
        {{ Form::text('name', $user->display_name, array('placeholder' => 'Display Name')) }}

        {{-- CURRENT PASSWORD FIELD --}}
        {{ Form::label('cur_password', 'Current Password') }}
        {{ Form::password('cur_password', array('placeholder' => 'Current Password')) }}

        {{-- NEW PASSWORD FIELD --}}
        {{ Form::label('new_password', 'New Password') }}
        {{ Form::password('new_password', array('placeholder' => 'Password')) }}

        {{-- NEW PASSWORD CONFIRMATION FIELD --}}
        {{ Form::label('new_password_confirmation', 'Password Confirmation') }}
        {{ Form::password('new_password_confirmation', array('placeholder' => 'Password')) }}

        {{ Form::reset('Reset') }}
        {{ Form::submit('Submit') }}
    {{ Form::close() }}
@stop