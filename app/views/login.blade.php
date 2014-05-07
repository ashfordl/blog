@extends('templates.base')

@section('title')
    Login | Blog
@stop

@section('body')
    <h3>Login</h3>
    {{ Form::open(array('action' => 'UserController@postLogin')) }}

        @if(isset($login_error) && $login_error)
            <span class="error">Incorrect email or password. Please try again.</span>
        @endif

        {{-- EMAIL FIELD --}}
        {{ Form::label('email', 'E-Mail') }}
        {{ Form::email('email', '', array('placeholder' => 'example.name@email.com')) }}

        {{-- PASSWORD FIELD --}}
        {{ Form::label('password', 'Password') }}
        {{ Form::password('password', array('placeholder' => 'Password')) }}

        {{-- PERMANENT FIELD --}}
        {{ Form::checkbox('permanent', '0') }}
        {{ Form::label('permanent', 'Stay logged in?') }}

        {{ Form::submit('Log in') }}
    {{ Form::close() }}
@stop