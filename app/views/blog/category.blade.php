@extends('templates.base')

@section('title')
    {{{ substr($category->title, 0, 30) }}}
@stop

@section('body')
    <div class="row">
        <div class="post col-md-8 col-lg-6">
            <h1>
                <span>{{{ $category->title }}}</span>
                <small class="spaced-left">{{ count($posts) }} {{ count($posts) === 1 ? 'post' : 'posts' }}</small>
            </h1>
            <p><strong>{{{ $category->description }}}</strong></p>

            @include('templates.postlist')
        </div>
    </div>
@stop