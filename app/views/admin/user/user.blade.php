@extends('templates.base')

@section('title')
    Admin | {{ substr($user->display_name, 0, 22) }}
@stop

@section('body')
    <h1>User Admin - {{{ $user->display_name }}}</h1>

    <div class="row">
        <div class="col-md-8 col-lg-6">
            <h3>User Info</h3>
            <table class="table table-condensed">
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
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-lg-6">
            <h3>Bans</h3>
            @if ($user->isBanned())
                <div class="panel panel-warning">
                    <div class="panel-body clearfix">
                        <span class="btn-centered">
                            This user is currently banned. The ban {{ $user->receivedBans()->get()->last()->isPermanent() ? 'is permanent.' : ' expires on '.$user->receivedBans()->get()->last()->end.'.' }} 
                        </span>
                        <span class="pull-right">
                            <a class="btn btn-warning">Cancel</a>
                            <a class="btn btn-warning">Extend</a>
                        </span>
                    </div>
                </div>
            @else
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
            @endif

            @if (count($user->receivedBans()->get()) == 0)
                <div class="col-sm-offset-1 col-sm-6 col-lg-7 panel panel-info">
                    <div class="panel-body">This user has received no bans.</div>
                </div>
            @else
            <div class="col-xs-12 thin-sides-padding"><h5>Ban History</h5>
                <table class="table table-condensed">
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
                </div>
            @endif
        </div>
    </div>
@stop