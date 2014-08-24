@extends('templates.base')

@section('title')
    {{{ substr($category->title, 0, 30) }}}
@stop

@section('body')
    <div class="post col-md-8 col-lg-6">
        <h1>{{{ $category->title }}} <small>{{ count($posts) }} {{ count($posts) === 1 ? 'post' : 'posts' }}</small></h1>

        <p><strong>{{{ $category->description }}}</strong></p>

        @include('templates.postlist')
    </div>
@stop