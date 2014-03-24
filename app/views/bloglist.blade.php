@extends('templates.base')

@section('title')
    Post | Blog
@stop

@section('body')
    <h3>List of posts</h3>
    @foreach($posts as $post)
        <p><a href="{{ route('blogpost').'/'.$post->id }}">{{{ $post->title }}}</a></p>
    @endforeach
@stop