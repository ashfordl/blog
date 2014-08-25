<?php

class Blogpost extends Eloquent
{
    /**
     * The validation rules for a blog post.
     *
     * @var array
     */
    protected static $postRules = array(
            'title' => 'required|max:255',
            'content' => 'required|max:1048576',
            'category' => 'numeric'
        );

    public static $postValidator;

    /**
     * Attempts to modify or create a blog post.
     *
     * @return bool
     */
    public static function attemptPost($data, $id = null)
    {
        // Validate input
        $validator = Validator::make($data, Blogpost::$postRules);

        if ($validator->fails())
        {
            // Invalid input
            Blogpost::$postValidator = $validator;
            return false;
        }

        // Modify / create the post appropriately
        $post = Blogpost::find($id);

        if (is_null($post)) // In case the id is bogus
            $post = new Blogpost();

        $post->title = $data['title'];
        $post->content = $data['content'];
        $post->deleted = (isset($data['deleted']) && $data['deleted']);

        // If "no category" is selected, or a non-existant value is given
        if ($data['category'] == 0 || null === Category::find($data['category']))
        {
            $post->category_id = null;
        }
        else
        {
            $post = Category::find($data['category'])->blogposts()->save($post);
        }

        $post->save();

        // Set validator
        Blogpost::$postValidator = $validator;
        return true;
    }

    public function scopeVisible($query)
    {
        return $query->where('deleted', '=', '0');
    }

    public function tags()
    {
        return $this->belongsToMany('Tag');
    }

    public function getCategory()
    {
        return Category::find($this->category_id);
    }

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

    /**
     * Returns the next visible blogpost by ID
     *
     * @return Blogpost
     */
    public function next()
    {
        return Blogpost::visible()->where('id', '>', $this->id)->orderBy('id')->first();
    }

    /**
     * Returns the previous visible blogpost by ID
     *
     * @return Blogpost
     */
    public function prev()
    {
        return Blogpost::visible()->where('id', '<', $this->id)->orderBy('id', 'desc')->first();
    }
}