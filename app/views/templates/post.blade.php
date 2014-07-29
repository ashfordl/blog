@if (isset($post))
    <h1>{{{ $post->title }}}</h1>

    {{-- Format with paragraph tags, and escape and html entities (eg angle brackets) --}}
    <p>{{ str_replace(array("\n","\r\n"), "</p><p>", e($post->content)) }}</p>

    <p>{{{ $post->tags }}}</p>
@else
    <h1>Sorry! That post doesn't exist!</h1>
    <p>Unfortunately the post you were looking for isn't in the database. Maybe try looking in the <a href="{{ route('bloglist') }}">archive</a> for the post you were seeking.</p>
@endif