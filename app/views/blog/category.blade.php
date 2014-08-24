@extends('templates.base')

@section('title')
    {{{ substr($category->title, 0, 30) }}}
@stop

@section('body')
    <div class="post col-md-8 col-lg-6">
        <h1>{{{ $category->title }}}</h1>

        <p><strong>{{{ $category->description }}}</strong></p>

        @include('templates.postlist', array('posts' => $category->blogposts))
    </div>
@stop