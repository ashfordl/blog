@extends('templates.base')

@section('title')
    Banned
@stop

@section('body')
    <h1>Banned</h1>
    <p>You have been banned. Ban {{ $ban->isPermanent() ? 'is permanent.' : ' expires on '.$ban->end.'.' }}</p>
    <p><b>Issued By</b> {{ $ban->issuer->display_name }}</p>
    <p><b>Comment</b> {{{ $ban->comment }}}</p>
    <p>To appeal, please email appeal(at)localhost</p>
@stop