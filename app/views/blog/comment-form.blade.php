<div class="row">
    {{ Form::open(array('action' => array('BlogController@postComment', $post->id)), array('class' => 'form-horizontal')) }}

    @if(isset($errors) && $errors->first() != "")
    <div class="col-xs-12">
        <div class="panel panel-danger">
            <div class="panel-body">
                {{ $errors->first() }}
            </div>
        </div>
    </div>
    @endif

    <div class="form-group col-md-10">
    {{-- TEXT FIELD --}}
    {{ Form::label('text', 'Text', array('class' => 'sr-only')) }}
    {{ Form::textarea('text', null, array('class' => 'form-control', 'rows' => '4', 'maxlength' => '1000', 'data-')) }}
    </div>

    <div class="form-group col-md-2">
    <p class="spaced-top text-center">1000 characters maximum</p>

    {{ Form::submit('Comment', array('class' => 'btn btn-primary btn-block')) }}
    </div>
</div>