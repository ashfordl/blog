{{-- Must include a $posts variable containing the posts to display --}}

<ul class="list-unstyled">
    @foreach ($posts as $post)
        <li>
            <a href="{{ action('BlogController@getPost', array($post->id, $post->getTitleURLString())) }}"><h3>{{{ substr($post->title, 0, 60) }}}</h3></a>
            <hr>
        </li>
    @endforeach
</ul>