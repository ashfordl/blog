@extends('templates.base')

@section('title')
    Blog Admin
@stop

@section('body')
    <h1>Blog Admin</h1>

    <a href="{{ action('BlogAdminController@getPost') }}"><h4>Create post</h4></a>
    <h4>Edit posts</h4>

    <div class="col-md-8 col-lg-6">
        <table class="table table-hover col-md-8 col-lg-6">
            <tr>
                <th>ID</th>
                <th>Title <small>Click to edit</small></th>
                <th>Date</th>
                <th>Status</th>
                <th></th>
            </tr>
        @foreach($posts as $post)
            <tr>
                <td>{{{ $post->id }}}</td>
                <td><a href="{{ action('BlogAdminController@getPost', array($post->id)) }}">{{{ $post->title }}}</a></td>
                <td>{{{ $post->created_at }}}</td>
                <td>{{{ $post->deleted ? 'Hidden' : 'Visible' }}}</td>
                @if (!$post->deleted)
                    <td><a href="{{ action('BlogController@getPost', array($post->id)) }}">View</a></td>
                @else
                    <td></td>
                @endif
            </tr>
        @endforeach
        </table>
    </div>
@stop