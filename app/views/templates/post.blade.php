<div class="row">
    <div class="col-md-10 col-lg-8">
        <h1>{{{ $post->title }}}</h1>

        {{-- Escape html entities, format with paragraph tags --}}
        {{-- Leading and trailing paragraph tags are required for leading and trailing paragraphs respectively --}}
        @bbcode($post->content)

        @if (isset($navLinks) && $navLinks && isset($category))
            <div class="forceheight">
                @if (!is_null($post->prev($category->id)))
                    <a class="pull-left spaced-bottom" href="{{ action('BlogController@getCategory',
                        array($category->id, $post->prev($category->id)->id, $post->prev($category->id)->getTitleURLString())
                    ) }}">&larr; Previous</a>
                @endif

                @if (!is_null($post->next($category->id)))
                    <a class="pull-right spaced-bottom" href="{{ action('BlogController@getCategory',
                        array($category->id, $post->next($category->id)->id, $post->next($category->id)->getTitleURLString())
                    ) }}">Next &rarr;</a>
                @endif
            </div>
        @elseif (isset($navLinks) && $navLinks)
            <div class="forceheight">
                @if (!is_null($post->prev()))
                    <a class="pull-left spaced-bottom" href="{{ action('BlogController@getPost',
                            array($post->prev()->id, $post->prev()->getTitleURLString())
                        )}}">&larr; Previous</a>
                @endif

                @if (!is_null($post->next()))
                    <a class="pull-right spaced-bottom" href="{{ action('BlogController@getPost',
                            array($post->next()->id, $post->next()->getTitleURLString())
                        )}}">Next &rarr;</a>
                @endif
            </div>
        @endif

        <div class="well well-sm clearfix">
            <span class="pull-left">Category: {{{ is_null($post->getCategory()) ? "No category" : $post->getCategory()->title }}}</span>
            <span class="pull-right">{{ $post->created_at }}</span>
        </div>

        <div>
        @if(count($post->comments) != 0)
            <h4>Comments ({{ count($post->comments) }})</h4>

            @include('blog.comment-form')

            <ul class="list-unstyled">
                @each('templates.comment', $post->comments()->whereNull('parent_id')->orderBy('created_at', 'desc')->get(), 'comment')
            </ul>
        @else
            <h4>There are no comments.</h4>

            @include('blog.comment-form')
        @endif
        </div>
    </div>
</div>