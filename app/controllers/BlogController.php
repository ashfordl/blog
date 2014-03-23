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
        // Display index of blog posts

        return View::make('bloglist');
    }

    public function getPost($id, $title="")
    {
        // Dispaly post where id = $id

        return View::make('blogpost');
    }
}