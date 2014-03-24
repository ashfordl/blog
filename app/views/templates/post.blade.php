@if (isset($post))
<h3>Blog post</h3>
<h1>{{{ $post->title }}}</h1>
<p>{{ $post->content }}</p>
<p>{{{ $post->tags }}}</p>
@else
<h3>Blog post</h3>
<h1>Sorry! That post doesn't exist!</h1>
<p>Unfortunately the post you were looking for isn't in the database. Maybe try looking at the <a href="{{ route('bloglist') }}">archives</a> for the post you were seeking.</p>
@endif