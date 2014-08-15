@extends('templates.base')

@section('title')
    Blog Admin
@stop

@section('body')
    <div class="col-md-8 col-lg-7">
        <h1>Blog Admin</h1>

        <a href="{{ action('BlogAdminController@getPost') }}"><h4>Create post</h4></a>

        <h4>Posts</h4>
        <table class="table table-hover">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Category</th>
                <th>Date</th>
                <th>Status</th>
                <th>Link</th>
            </tr>
        @foreach($posts as $post)
            <tr>
                <td>{{{ $post->id }}}</td>
                <td><a href="{{ action('BlogAdminController@getPost', array($post->id)) }}">{{{ $post->title }}}</a></td>
                <td>{{{ $post->getCategory()->title }}}</td>
                <td>{{{ $post->created_at }}}</td>
                <td>{{{ $post->deleted ? 'Hidden' : 'Visible' }}}</td>
                
                <td>@if (!$post->deleted)
                    <a href="{{ action('BlogController@getPost', array($post->id, $post->getTitleURLString())) }}">View</a>
                @endif </td>
                
            </tr>
        @endforeach
        </table>
    </div>
@stop