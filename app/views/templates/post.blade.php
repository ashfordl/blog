<div class="post">
    @if (isset($post))
        <h1>{{{ $post->title }}}</h1>

        {{-- Escape html entities, format with paragraph tags --}}
        {{-- Leading and trailing paragraph tags are required for leading and trailing paragraphs respectively --}}
        <p>{{ str_replace(array("\n","\r\n"), "</p><p>", e($post->content)) }}</p>

        <div class="well well-sm clearfix">
            <span class="pull-left">{{{ $post->tags }}}</span>
            <span class="pull-right">{{ $post->created_at }}</span>
        </div>
    @else
        <h1>Sorry! That post doesn't exist!</h1>
        <p>Unfortunately the post you were looking for isn't in the database. Maybe try looking in the <a href="{{ action('BlogController@getList') }}">archive</a> for the post you were seeking.</p>
    @endif
</div>