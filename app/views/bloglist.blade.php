@extends('templates.base')

@section('title')
    Archive
@stop

@section('body')
    <h1>Archive</h1>
    <ul>
        @foreach($posts as $post)
            <li><a href="{{ action('BlogController@getPost', array($post->id)) }}">{{{ $post->title }}}</a></li>
        @endforeach
    </ul>
@stop