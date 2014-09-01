@extends('templates.base')

@section('title')
    Settings
@stop

@section('body')
<div class="row">
    <div class="col-sm-5 col-lg-4">
        <h1>Settings</h1>
        {{ Form::open(array('action' => 'UserController@postSettings')) }}

            {{-- SUCCESSES --}}
            @foreach($successes as $success)
                <div class="panel panel-success">
                    <div class="panel-body">
                        {{ $success }}
                    </div>
                </div>
            @endforeach

            {{-- ERRORS --}}
            @foreach($errors as $error)
                <div class="panel panel-danger">
                    <div class="panel-body">
                        {{ $error }}
                    </div>
                </div>
            @endforeach

            <div class="form-group">
            {{-- EMAIL FIELD --}}
            {{ Form::label('email', 'Email') }}
            {{ Form::text('email', $user->email, array('disabled', 'class' => 'form-control')) }}
            </div>

            <div class="form-group">
            {{-- NAME FIELD --}}
            {{ Form::label('name', 'Display Name') }}
            {{ Form::text('name', $user->display_name, array('placeholder' => 'Display name', 'class' => 'form-control')) }}
            </div>

            <div class="form-group">
            {{-- CURRENT PASSWORD FIELD --}}
            {{ Form::label('cur_password', 'Current Password') }}
            {{ Form::password('cur_password', array('placeholder' => 'Current password', 'class' => 'form-control')) }}
            </div>

            <div class="form-group">
            {{-- NEW PASSWORD FIELD --}}
            {{ Form::label('new_password', 'New Password') }}
            {{ Form::password('new_password', array('placeholder' => 'New password', 'class' => 'form-control')) }}
            </div>

            <div class="form-group">
            {{-- NEW PASSWORD CONFIRMATION FIELD --}}
            {{ Form::label('new_password_confirmation', 'Password Confirmation') }}
            {{ Form::password('new_password_confirmation', array('placeholder' => 'Confirm new password', 'class' => 'form-control')) }}
            </div>

            {{ Form::reset('Reset', array('class' => 'btn btn-warning btn-block')) }}
            {{ Form::submit('Submit', array('class' => 'btn btn-primary btn-block')) }}
        {{ Form::close() }}
    </div>
</div>
@stop