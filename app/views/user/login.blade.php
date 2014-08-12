@extends('templates.base')

@section('title')
    Login
@stop

@section('body')
    <div class="col-sm-5 col-lg-4">
        <h1>Login</h1>
        {{ Form::open(array('action' => 'UserController@postLogin')) }}

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
                <label>
                    {{ Form::checkbox('permanent') }} Remember me?
                </label>
            </div>

            {{ Form::submit('Log in', array('class' => 'btn btn-primary btn-block')) }}
        {{ Form::close() }}
    </div>
@stop