@extends('templates.base')

@section('title')
    Register
@stop

@section('body')
<div class="col-sm-5 col-lg-4">
    <h1>Register</h1>
    {{ Form::open(array('action' => 'UserController@postRegister')) }}

        @if(isset($errors) && $errors->first() != "")
            <div class="panel panel-danger">
                <div class="panel-body">
                    {{ $errors->first() }}
                </div>
            </div>
        @endif

        <div class="form-group">
        {{-- NAME FIELD --}}
        {{ Form::label('name', 'Display Name') }}
        {{ Form::text('name', '', array('placeholder' => 'Display Name', 'class' => 'form-control')) }}
        </div>

        <div class="form-group">
        {{-- EMAIL FIELD --}}
        {{ Form::label('email', 'Email Address') }}
        {{ Form::email('email', '', array('placeholder' => 'Email', 'class' => 'form-control')) }}
        </div>

        <div class="form-group">
        {{-- EMAIL CONFIRMATION FIELD --}}
        {{ Form::label('email_confirmation', 'E-Mail Confirmation') }}
        {{ Form::email('email_confirmation', '', array('placeholder' => 'Confirm email', 'class' => 'form-control')) }}
        </div>

        <div class="form-group">
        {{-- PASSWORD FIELD --}}
        {{ Form::label('password', 'Password') }}
        {{ Form::password('password', array('placeholder' => 'Password', 'class' => 'form-control')) }}
        </div>

        <div class="form-group">
        {{-- PASSWORD CONFIRMATION FIELD --}}
        {{ Form::label('password_confirmation', 'Password Confirmation') }}
        {{ Form::password('password_confirmation', array('placeholder' => 'Confirm password', 'class' => 'form-control')) }}
        </div>

        {{ Form::submit('Register', array('class' => 'btn btn-primary btn-block')) }}
    {{ Form::close() }}
</div>
@stop