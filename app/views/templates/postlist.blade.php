<ul class="list-unstyled">
    @foreach ($posts as $post)
        <li>
            @if (isset($category))
                <a href="{{ action('BlogController@getCategory',
                            array($category->id, $post->id, $post->getTitleURLString())
                        ) }}">
                    <h3>{{{ substr($post->title, 0, 60) }}}</h3>
                </a>
            @else
                <a href="{{ action('BlogController@getPost', array($post->id, $post->getTitleURLString())) }}">
                    <h3>{{{ substr($post->title, 0, 60) }}}</h3>
                </a>
            @endif
            <hr>
        </li>
    @endforeach
</ul>