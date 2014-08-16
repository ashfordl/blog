@extends('templates.base')

@section('title')
    Categories
@stop

@section('body')
    <div class="col-md-8 col-lg-7">
        <h1>Categories</h1>

        <table class="table table-hover">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
            </tr>
        @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td class="editable">{{{ $category->title }}}</td>
                <td class="editable">{{{ $category->description }}}</td>
            </tr>
        @endforeach
        </table>
    </div>
@stop

@section('js')
    @include('jsvars.admin-blog-categories')
    <script src="{{ asset('res/js/categories.js') }}"></script>
@stop