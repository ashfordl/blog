<?php

class BlogController extends BaseController {

	public function getIndex()
	{
        // Display most recent post
        $post = Blogpost::visible()
                        ->orderBy('created_at')
                        ->get()
                        ->last();

		return View::make('index')
                ->with('post', $post);
	}

    public function getList()
    {
        $posts = Blogpost::visible()
                        ->orderBy('created_at')
                        ->get()
                        ->reverse();

        return View::make('bloglist')
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
            return Redirect::route('blogpost', array($id, $titleURL));
        }

        return View::make('blogpost')
                ->with('post', $post);
    }
}