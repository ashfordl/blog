<div class="post col-md-10 col-lg-8">
    @if (isset($post))
        <h1>{{{ $post->title }}}</h1>

        {{-- Escape html entities, format with paragraph tags --}}
        {{-- Leading and trailing paragraph tags are required for leading and trailing paragraphs respectively --}}
        <p>{{ str_replace(array("\n","\r\n"), "</p><p>", e($post->content)) }}</p>

        <div class="forceheight" id="post-navlinks">
            @if(isset($prev))
                <a class="pull-left" href="{{ action('BlogController@getPost', array($prev->id)) }}">&larr; Previous</a>
            @endif
            @if(isset($next))
                <a class="pull-right" href="{{ action('BlogController@getPost', array($next->id)) }}">Next &rarr;</a>
            @endif
        </div>

        <div class="well well-sm clearfix">
            <span class="pull-left">{{{ $post->tags }}}</span>
            <span class="pull-right">{{ $post->created_at }}</span>
        </div>
    @else
        <h1>Sorry! That post doesn't exist!</h1>
        <p>Unfortunately the post you were looking for isn't in the database. Maybe try looking in the <a href="{{ action('BlogController@getList') }}">archive</a> for the post you were seeking.</p>
    @endif
</div>