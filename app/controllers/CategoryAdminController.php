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

    public function postEdit()
    {
        
    }
}