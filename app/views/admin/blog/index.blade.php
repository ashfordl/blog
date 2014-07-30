@extends('templates.base')

@section('title')
    Blog Admin
@stop

@section('body')
    <h1>Blog Admin</h1>
    <a href="{{ action('BlogAdminController@getPost') }}"><h3>Create post</h3></a>
    <h3>Edit posts</h3>
    <table>
        <tr>
            <th>Title</th>
            <th>Date</th>
            <th>Status</th>
        </tr>
    @foreach($posts as $post)
        <tr>
            <td><a href="{{ action('BlogAdminController@getPost', array($post->id)) }}">{{{ $post->title }}}</a></td>
            <td>{{{ $post->created_at }}}</td>
            <td>{{{ $post->deleted ? 'Hidden' : 'Visible' }}}</td>
            @if (!$post->deleted)
                <td><a href="{{ action('BlogController@getPost', array($post->id)) }}">View</a></td>
            @endif
        </tr>
    @endforeach
    </table>
@stop