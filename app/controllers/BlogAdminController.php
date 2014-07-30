<?php

class BlogAdminController extends BaseController 
{
    public function __construct()
    {
        $this->beforeFilter('admin');
        $this->beforeFilter('csrf', array('on' => 'post'));
    }

    public function getIndex()
    {
        $posts = Blogpost::orderBy('created_at')
                        ->get()
                        ->reverse();

        return View::make('admin.blog.index')
                ->with('posts', $posts);
    }

    public function getPost($id = null, $title = "")
    {
        $post = Blogpost::find($id);

        // If fail, abort
        if (is_null($post))
        {
            App::abort(404);
        }

        // Append the title to the URL
        $titleURL = $post->getTitleURLString();
        if ($title != $titleURL)
        {
            return Redirect::action('BlogAdminController@getPost', array($id, $titleURL));
        }

        return View::make('admin.blog.edit')
                ->with('post', $post);
    }

    public function postPost($id = null)
    {
        if (Blogpost::attemptPost(Input::all(), $id))
        {
            return Redirect::action('BlogAdminController@getIndex');
        }
        else
        {
            return Redirect::action('BlogAdminController@getPost')
                ->withErrors(Blogpost::$postValidator)
                ->withInput();
        }
    }
}