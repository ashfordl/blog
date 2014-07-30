@extends('templates.base')

@section('title')
    Archive
@stop

@section('body')
    <h1>Archive of posts</h1>
    @foreach($posts as $post)
        <p><a href="{{ action('BlogController@getPost', array($post->id)) }}">{{{ $post->title }}}</a></p>
    @endforeach
@stop