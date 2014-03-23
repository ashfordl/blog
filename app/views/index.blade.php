@extends('templates.base')

@section('title')
    Index | Blog
@stop

@section('body')
    <h3>Index</h3>
    <h1>{{{ $post->title }}}</h1>
    <p>{{ $post->content }}</p>
    <p>{{{ $post->tags }}}</p>
@stop