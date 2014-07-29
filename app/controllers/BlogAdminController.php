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

    public function getPost($id = null)
    {
        $post = Blogpost::find($id);

        return View::make('admin.blog.edit')
                ->with('post', $post);
    }

    public function postPost($id = null)
    {
        $data = Input::all();
        $rules = array(
            'title' => 'required|max:255',
            'content' => 'required|max:1048576'
            );

        $validator = Validator::make($data, $rules);

        // If the input is invalid, fail
        if ($validator->fails()) {
            return Redirect::action('BlogAdminController@getPost')
                ->withErrors($validator)
                ->withInput();
        }

        // Modify / create the post appropriately
        $post;
        if (is_null($id))
        {
            $post = new Blogpost();
        }
        else
        {
            $post = Blogpost::find($id);
            $post->touch();
        }

        $post->title = $data['title'];
        $post->content = $data['content'];
        $post->tags = $data['tags'];
        $post->deleted = $data['deleted'];

        $post->save();

        return Redirect::action('BlogAdminController@getIndex');
    }
}