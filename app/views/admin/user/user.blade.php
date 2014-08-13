@extends('templates.base')

@section('title')
    Admin | {{ substr($user->display_name, 0, 22) }}
@stop

@section('body')
    <div class="col-md-8 col-lg-6">
        <h1>User Admin - {{{ $user->display_name }}}</h1>

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

        <h3>Bans</h3>
        @if ($user->isBanned())
            <div class="panel panel-warning" id="banned-panel">
                <div class="panel-body clearfix">
                    <span class="btn-centered" id="banned-message">
                        @include('admin.user.helpers.banned-message')
                    </span>
                    <span class="pull-right">
                        <a class="btn btn-warning" id="cancel-ban">Cancel</a>
                        <a class="btn btn-warning" id="extend-ban">Extend</a>
                    </span>
                </div>
            </div>

            <div id="ban-form"></div>
        @else
            <div id="ban-form">@include('admin.user.helpers.ban-form')</div>
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
            @foreach ($user->receivedBans()->get()->reverse() as $ban)
                <tr>
                    <td class="hidden">{{ $ban->id }}</td>
                    <td>{{{ $ban->issuer->display_name }}}</td>
                    <td>{{ $ban->start }}</td>
                    <td class="ban-end">{{ isset($ban->end) ? $ban->end : 'Permanent' }}</td>
                    <td class="ban-valid">{{ $ban->valid ? 'Valid' : 'Invalid' }}</td>
                    <td>{{{ $ban->comment }}}</td>
                </tr>
            @endforeach
            </table>
        </div>
        @endif
    </div>
@stop

@section('js')
    @include('jsvars.admin-user')
    <script src="{{ asset('res/js/ban.js') }}"></script>
@stop