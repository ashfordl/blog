@extends('templates.base')

@section('title')
    Banned
@stop

@section('body')
    <h1>Banned</h1>
    <p>You have been banned. Your ban {{ $ban->isPermanent() ? 'is permanent.' : ' expires on '.$ban->end.'.' }}</p>
    <h4>Issued By</h4><p>{{ $ban->issuer->display_name }}</p>
    <h4>Comment</h4><p>{{{ $ban->comment }}}</p>
    <h4>Appeal</h4><p>To appeal, please email appeal&#64;localhost</p>
@stop