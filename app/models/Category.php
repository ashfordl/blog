<?php

class Category extends Eloquent
{

/**                   **/
/** LARAVEL VARIABLES **/
/**                   **/

    /**
     * {@inheritDoc}
     */
    public $timestamps = false;





/**               **/
/** RELATIONSHIPS **/
/**               **/

    /**
     * The relationship Category has many Blogpost.
     *
     * @return HasMany
     */
    public function blogposts()
    {
        return $this->hasMany('Blogpost');
    }
    




/**            **/
/** PROPERTIES **/
/**            **/

    /**
     * A URL-safe string of the title.
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

    /**
     * The validation rules to create a new category.
     *
     * @var array
     */
    public static $newRules = array(
                'title'         => 'max:255',
                'description'   => 'max:255',
            );

    /**
     * The validator last used to create a category.
     *
     * @var Validator
     */
    public static $newValidator;

    /**
     * Attempts to create a new category.
     *
     * @return bool
     */
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