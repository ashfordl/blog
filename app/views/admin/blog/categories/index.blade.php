@extends('templates.base')

@section('title')
    Categories
@stop

@section('body')
    <h1>Categories</h1>

    <div class="col-md-8 col-lg-6">
        <h3>Edit categories</h3>
        <table class="table table-hover">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th class="text-right">Delete</th>
            </tr>
        @foreach($categories as $category)
            <tr data-category-id="{{ $category->id }}">
                <td><span class="btn-centered">{{ $category->id }}</span></td>
                <td class="editable"><span class="btn-centered">{{{ $category->title }}}</span></td>
                <td class="editable"><span class="btn-centered">{{{ $category->description }}}</span></td>
                <td class="text-right"><button class="btn btn-warning js-delete-category" type="button"><span class="glyphicon glyphicon-remove"></span></button></td>
            </tr>
        @endforeach
        </table>
    </div>

    <div class="col-md-8 col-lg-6">
        <h3>Create new category</h3>
        {{ Form::open(array('action' => 'CategoryAdminController@postNew')) }}

            @if(isset($errors) && $errors->first() != "")
                <div class="panel panel-danger">
                    <div class="panel-body">
                        {{ $errors->first() }}
                    </div>
                </div>
            @endif

            <div class="form-group">
            {{-- TITLE FIELD --}}
            {{ Form::label('title', 'Title') }}
            {{ Form::text('title', null, array('placeholder' => 'Title', 'class' => 'form-control')) }}
            </div>

            <div class="form-group">
            {{-- TITLE FIELD --}}
            {{ Form::label('description', 'Description') }}
            {{ Form::textarea('description', null, array('class' => 'form-control', 'rows' => '3')) }}
            </div>

            {{ Form::submit('Submit', array('class' => 'btn btn-primary btn-block')) }}
        {{ Form::close() }}
    </div>
@stop

@section('js')
    @include('jsvars.admin-blog-categories')
    <script src="{{ asset('res/js/categories.js') }}"></script>
@stop