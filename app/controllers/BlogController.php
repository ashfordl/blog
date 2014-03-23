<?php

class BlogController extends BaseController {

	public function getIndex()
	{
        // Display most recent post

		return View::make('index');
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