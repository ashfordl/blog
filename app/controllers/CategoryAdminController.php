<?php

class CategoryAdminController extends BaseController 
{
    public function __construct()
    {
        $this->beforeFilter('admin');
        $this->beforeFilter('csrf', array('on' => 'post'));
    }

    public function getIndex()
    {
        $categories = Category::all();

        return View::make('admin.blog.categories.index')
            ->with('categories', $categories);
    }

    public function postNew()
    {
        if (Category::attemptNew(Input::all()))
        {
            // Creation successful
            return Redirect::action('CategoryAdminController@getIndex');
        }
        else
        {
            // Creation unsuccessful
            return Redirect::action('CategoryAdminController@getIndex')
                        ->withErrors(Category::$newValidator)
                        ->withInput();
        }
    }

    public function postEdit()
    {
        $data = Input::all();
        $rules = array(
                'id'    => 'required|exists:categories,id',
                'title' => 'required_without:description|max:255',
                'description'   => 'required_without:title|max:255',
            );
        $validator = Validator::make($data, $rules);

        if ($validator->fails())
        {
            // If data is invalid, return status 400
            return Response::make($validator->errors()->first(), 400);
        }

        // The category to update
        $category = Category::find($data['id']);

        // Update the title, if present
        if (isset($data['title'])) {
            $category->title = $data['title'];
        }

        // Update the description, if present
        if (isset($data['description'])) {
            $category->description = $data['description'];
        }

        // Save the changes
        $category->save();

        return $category;
    }
}