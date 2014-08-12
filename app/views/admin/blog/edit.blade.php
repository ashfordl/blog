@extends('templates.base')

@section('title')
    @if (isset($post))
        Edit | {{ substr($post->title, 0, 23) }}
    @else
        Create
    @endif
@stop

@section('body')
    <div class="col-sm-8 col-md-7 col-lg-6">
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

            <div class-"form-group">
                <label>
                    {{ Form::checkbox('deleted') }} Hidden?
                </label>
            </div>

            {{ Form::submit('Submit', array('class' => 'btn btn-primary btn-block')) }}
            {{ Form::reset('Reset', array('class' => 'btn btn-warning btn-block')) }}

            <a href="{{ action('BlogAdminController@getIndex') }}" class="btn btn-warning btn-block">Cancel</a>

        {{ Form::close() }}
    </div>
@stop