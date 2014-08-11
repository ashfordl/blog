@extends('templates.base')

@section('title')
    {{ substr($post->title, 0, 30) }}
@stop

@section('body')
    @include('templates.post')
@stop