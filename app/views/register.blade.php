@extends('templates.base')

@section('title')
    Login | Blog
@stop

@section('body')
    <h3>Register</h3>
    {{ Form::open(array('route' => 'p_register')) }}

        @if (isset($errors))
            <span class="error">{{ $errors->first() }}</span>
        @endif

        {{-- NAME FIELD --}}
        {{ Form::label('name', 'Display Name') }}
        {{ Form::text('name', '', array('placeholder' => 'Display Name')) }}

        {{-- EMAIL FIELD --}}
        {{ Form::label('email', 'E-Mail') }}
        {{ Form::email('email', '', array('placeholder' => 'example.name@email.com')) }}

        {{-- EMAIL CONFIRMATION FIELD --}}
        {{ Form::label('email_confirmation', 'E-Mail Confirmation') }}
        {{ Form::email('email_confirmation', '', array('placeholder' => 'example.name@email.com')) }}

        {{-- PASSWORD FIELD --}}
        {{ Form::label('password', 'Password') }}
        {{ Form::password('password', array('placeholder' => 'Password')) }}

        {{-- PASSWORD CONFIRMATION FIELD --}}
        {{ Form::label('password_confirmation', 'Password Confirmation') }}
        {{ Form::password('password_confirmation', array('placeholder' => 'Password')) }}

        {{ Form::submit('Register') }}
    {{ Form::close() }}
@stop