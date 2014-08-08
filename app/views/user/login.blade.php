@extends('templates.base')

@section('title')
    Login
@stop

@section('body')
    <h3>Login</h3>
    {{ Form::open(array('action' => 'UserController@postLogin', 'class' => 'col-sm-5 col-lg-4')) }}

        @if(isset($login_error) && $login_error)
            <div class="panel panel-danger">
                <div class="panel-body">
                    Incorrect email or password. Please try again.
                </div>
            </div>
        @endif

        <div class="form-group">
        {{-- EMAIL FIELD --}}
        {{ Form::label('email', 'Email Address') }}
        {{ Form::email('email', '', array('placeholder' => 'Email', 'class' => 'form-control')) }}
        </div>

        <div class="form-group">
        {{-- PASSWORD FIELD --}}
        {{ Form::label('password', 'Password') }}
        {{ Form::password('password', array('placeholder' => 'Password', 'class' => 'form-control')) }}
        </div>

        <div class="form-group">
        {{-- PERMANENT FIELD --}}
        {{ Form::checkbox('permanent', '0', array('class' => 'form-control')) }}
        {{ Form::label('permanent', 'Remember me?') }}
        </div>

        {{ Form::submit('Log in', array('class' => 'btn btn-primary btn-block')) }}
    {{ Form::close() }}
@stop