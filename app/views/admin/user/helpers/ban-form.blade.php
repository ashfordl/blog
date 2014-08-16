<div class="col-sm-5 col-lg-4">
    <h5 class="no-column-gap">Ban this user</h5>
    {{ Form::open(array('action' => array('UserAdminController@postBan'), 'class' => 'form-horizontal')) }}
        @if(isset($errors))
            <div class="panel panel-danger input-block-level no-column-gap">
                <div class="panel-body">
                    {{ $errors->first() }}
                </div>
            </div>
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