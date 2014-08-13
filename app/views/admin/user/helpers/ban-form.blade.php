<h5>Ban this user</h5>
<div>
    {{ Form::open(array('action' => array('UserAdminController@postBan'), 'class' => 'form-horizontal col-sm-5 col-lg-4')) }}
        @if(isset($errors))
            <span class="error">{{ $errors->first() }}</span>
        @endif

        {{-- ID of banned player --}}
        {{ Form::hidden('user', $user->id) }}

        <div class="form-group">
        {{-- DAYS FIELD --}}
        {{ Form::label('length', 'Length') }}
        {{ Form::text('length', '3', array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
        {{-- COMMENT FIELD --}}
        {{ Form::label('comment', 'Comment') }}
        {{ Form::text('comment', null, array('placeholder' => 'Comment', 'class' => 'form-control')) }}
        </div>

        <div class="form-group">
        {{ Form::submit('Ban', array('class' => 'btn btn-danger btn-block')) }}
        </div>
    {{ Form::close() }} 
</div>