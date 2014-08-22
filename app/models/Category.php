<?php

class Category extends Eloquent
{
    public $timestamps = false;

    public function blogposts()
    {
        return $this->hasMany('Blogpost');
    }

    public static $newRules = array(
                'title'         => 'max:255',
                'description'   => 'max:255',
            );

    public static $newValidator;

    public static function attemptNew($data)
    {
        // Validate input
        $validator = Validator::make($data, Category::$newRules);
        Category::$newValidator = $validator;

        if ($validator->fails())
        {
            // Invalid input
            return false;
        }

        // Create a new category
        $category = new Category();
        $category->title = $data['title'];
        $category->description = $data['description'];
        $category->save();

        return true;
    }
}