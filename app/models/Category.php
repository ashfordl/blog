<?php

class Category extends Eloquent
{

/**                   **/
/** LARAVEL VARIABLES **/
/**                   **/

    public $timestamps = false;





/**               **/
/** RELATIONSHIPS **/
/**               **/

    public function blogposts()
    {
        return $this->hasMany('Blogpost');
    }
    




/**            **/
/** PROPERTIES **/
/**            **/

    /**
     * Returns a URL-safe string of the title
     *
     * @return string
     */
    public function getTitleURLString()
    {
        return preg_replace('/^-+|-+$/', '', strtolower(
            preg_replace('/[^a-zA-Z0-9]+/', '-', substr($this->title, 0, 40))));
    }




/**            **/
/** VALIDATION **/
/**            **/

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