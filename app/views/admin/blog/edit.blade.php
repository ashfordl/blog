@extends('templates.base')

@section('title')
    @if (isset($post))
        Edit | {{ substr($post->title, 0, 23) }}
    @else
        Create
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
        {{ Form::model($post, array('action' => array('BlogAdminController@postPost', $post->id), 'class' => 'col-sm-8 col-md-7 col-lg-6')) }}
    @else
        {{ Form::open(array('action' => array('BlogAdminController@postPost', null), 'class' => 'col-sm-8 col-md-7 col-lg-6')) }}
    @endif

    <div class="form-group">
    {{-- TITLE FIELD --}}
    {{ Form::label('title', 'Title') }}
    {{ Form::text('title', null, array('placeholder' => 'Title', 'class' => 'form-control')) }}
    </div>

    <div class="form-group">
    {{-- CONTENT FIELD --}}
    {{ Form::label('content', 'Content') }}
    {{ Form::textarea('content', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
    {{-- TAGS FIELD --}}
    {{ Form::label('tags', 'Tags') }}
    {{ Form::text('tags', null, array('title' => 'Separate tags with spaces', 'class' => 'form-control')) }}
    </div>

    <div class="form-group">
    {{-- VISIBILITY --}}
    {{ Form::label('deleted', 'Visibility') }}
    {{ Form::select('deleted', array(
        '0' => 'Visible',
        '1' => 'Hidden',
        ), isset($post) && $post->deleted ? '1' : '0'
        , array('class' => 'form-control')) }}
    </div>

    {{ Form::reset('Reset', array('class' => 'btn btn-warning btn-block')) }}
    {{ Form::submit('Submit', array('class' => 'btn btn-primary btn-block')) }}

    <a href="{{ action('BlogAdminController@getIndex') }}" class="btn btn-warning btn-block">Cancel</a>

    {{ Form::close() }}
@stop