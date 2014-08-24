<?php

class BlogController extends BaseController {

	public function getIndex()
	{
        // Display most recent post
        $post = Blogpost::visible()
                        ->get()
                        ->last();

		return View::make('index')
                ->with('post', $post);
	}

    public function getList()
    {
        $posts = Blogpost::visible()
                        ->get()
                        ->reverse();

        return View::make('blog.bloglist')
                ->with('posts', $posts);
    }

    public function getPost($id, $title="")
    {
        $post = Blogpost::visible()
                        ->find($id);

        // If fail, abort
        if (is_null($post))
        {
            App::abort(404);
        }

        // Append the title to the URL
        $titleURL = $post->getTitleURLString();
        if ($title != $titleURL)
        {
            return Redirect::action('BlogController@getPost', array($id, $titleURL));
        }

        return View::make('blog.blogpost')
                ->with('post', $post)
                ->with('next', $post->next())
                ->with('prev', $post->prev());
    }

    public function getCategory($id, $title="")
    {
        $category = Category::find($id);

        // If fail, abort
        if (is_null($category))
        {
            App::abort(404);
        }

        // Append the title to the URL
        $titleURL = $category->getTitleURLString();
        if ($title != $titleURL)
        {
            return Redirect::action('BlogController@getCategory', array($id, $titleURL));
        }

        return View::make('blog.category')
                ->with('category', $category)
                ->with('posts', $category->blogposts()->visible()->get());
    }
}