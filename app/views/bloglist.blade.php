@extends('templates.base')

@section('title')
    Archive
@stop

@section('body')
    <div class="post col-md-8 col-lg-6">
        <h1>Archive</h1>

        <table class="table">
            <tr>
                <th>Title</th>
                {{-- <th>Category</th> --}}
                <th>Published</th>
            </tr>
            @foreach($posts as $post)
                <tr>
                    <td><a href="{{ action('BlogController@getPost', array($post->id, $post->getTitleURLString())) }}">{{{ $post->title }}}</a></td>
                    {{-- <td>{{ $post->category }}</td> --}}
                    <td>{{ $post->created_at }}</td>
                </tr>
            @endforeach
        </table>
    </div>
@stop