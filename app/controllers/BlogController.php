<?php

class BlogController extends BaseController {

	public function getIndex()
	{
        // Display most recent post
        $post = Blogpost::orderBy('created_at')
                        ->get()
                        ->last();

		return View::make('index')
                ->with('post', $post);
	}

    public function getList()
    {
        $posts = Blogpost::where('deleted', '=', 0)
                        ->orderBy('created_at')
                        ->get()
                        ->reverse();

        return View::make('bloglist')
                ->with('posts', $posts);
    }

    public function getPost($id, $title="")
    {
        $post = Blogpost::find($id);


        return View::make('blogpost')
                ->with('post', $post);
    }
}