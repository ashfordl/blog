@extends('templates.base')

@section('title')
    @if (isset($post))
        Edit Post
    @else
        Create Post
    @endif
@stop

@section('body')
    @if (isset($post))
        <h1>Edit Post</h1>
    @else
        <h1>Create Post</h1>
    @endif

    {{-- If there is a valid model, bind it to the form. Else use a blank form. --}}
    @if (isset($post))
        {{ Form::model($post, array('action' => array('BlogAdminController@postPost', $post->id))) }}
    @else
        {{ Form::open(array('action' => array('BlogAdminController@postPost', null))) }}
    @endif

    {{-- TITLE FIELD --}}
    {{ Form::label('title', 'Title') }}
    {{ Form::text('title', null, array('placeholder' => 'Title')) }}

    {{-- CONTENT FIELD --}}
    {{ Form::label('content', 'Content') }}
    {{ Form::textarea('content') }}

    {{-- TAGS FIELD --}}
    {{ Form::label('tags', 'Tags') }}
    {{ Form::text('tags', null, array('title' => 'Separate tags with spaces')) }}

    {{-- VISIBILITY --}}
    {{ Form::label('deleted', 'Visibility') }}
    {{ Form::select('deleted', array(
        '0' => 'Visible',
        '1' => 'Hidden',
        )) }}

    {{ Form::reset('Reset') }}
    {{ Form::submit('Submit') }}

    <a href="{{ action('BlogAdminController@getIndex') }}">{{ Form::button('Cancel') }}</a>

    {{ Form::close() }}
@stop