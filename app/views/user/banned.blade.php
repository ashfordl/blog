@extends('templates.base')

@section('title')
    Banned
@stop

@section('body')
    <h1>Banned</h1>
    <p>You have been banned. Your ban {{ $ban->isPermanent() ? 'is permanent.' : ' expires on '.$ban->end.'.' }}</p>
    <h5>Issued By</h5><p>{{ $ban->issuer->display_name }}</p>
    <h5>Comment</h5><p>{{{ $ban->comment }}}</p>
    <h5>Appeal</h5><p>To appeal, please email <a href="mailto:appeal@localhost">appeal&#64;localhost</a></p>
@stop