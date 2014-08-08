@extends('templates.base')

@section('title')
    Blog Admin
@stop

@section('body')
    <h1>Blog Admin</h1>

    <a href="{{ action('BlogAdminController@getPost') }}"><h4>Create post</h4></a>
    <h4>Posts</h4>

    <div class="col-md-8 col-lg-6">
        <table class="table table-hover">
            <tr>
                <th>ID</th>
                <th>Title <small>Click to edit</small></th>
                <th>Date</th>
                <th>Status</th>
                <th>Link</th>
            </tr>
        @foreach($posts as $post)
            <tr>
                <td>{{{ $post->id }}}</td>
                <td><a href="{{ action('BlogAdminController@getPost', array($post->id)) }}">{{{ $post->title }}}</a></td>
                <td>{{{ $post->created_at }}}</td>
                <td>{{{ $post->deleted ? 'Hidden' : 'Visible' }}}</td>
                
                <td>@if (!$post->deleted)
                    <a href="{{ action('BlogController@getPost', array($post->id)) }}">View</a>
                @endif </td>
                
            </tr>
        @endforeach
        </table>
    </div>
@stop