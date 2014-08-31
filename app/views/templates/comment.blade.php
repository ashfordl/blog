<li class="row comment">
    <div class="col-md-8 col-lg-9">
        @bbcode($comment->text)
    </div>
    <div class="col-md-4 col-lg-3">
        <div class="row"><div class="col-xs-12 text-right bold">{{{ $comment->user->display_name }}}</div></div>
        <div class="row"><div class="col-xs-12 text-right bold">Created {{{ $comment->created_at }}}</div></div>
        @if ($comment->created_at != $comment->updated_at)
            <div class="row"><div class="col-xs-12 text-right italics">Edited {{{ $comment->updated_at }}}</div></div>
        @endif
    </div>
</li>
<hr>

@if(count($comment->children) != 0)
    <div class="col-xs-11 col-xs-offset-1">
        <ul class="list-unstyled">
        @foreach($comment->children()->orderBy('created_at', 'desc')->get() as $reply)
            @include('templates.comment', array('comment' => $reply))
        @endforeach
        </ul>
    </div>
@endif