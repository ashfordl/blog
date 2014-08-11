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
            'content' => 'required|max:1048576'
        );

    public static $postValidator;

    /**
     * Attempts to modify or create a blog post.
     *
     * @return bool
     */
    public static function attemptPost($data, $id)
    {
        // Validate input
        $validator = Validator::make($data, Blogpost::$postRules);

        if ($validator->fails())
        {
            // Invalid input
            Blogpost::$postValidator = $validator;
            return false;
        }

        // Valid input
        // Modify / create the post appropriately
        $post;
        if (is_null($id))
        {
            $post = new Blogpost();
        }
        else
        {
            $post = Blogpost::find($id);
        }

        $post->title = $data['title'];
        $post->content = $data['content'];
        $post->tags = $data['tags'];
        $post->deleted = $data['deleted'];

        $post->save();

        // Set validator
        Blogpost::$postValidator = $validator;
        return true;
    }

    public function scopeVisible($query)
    {
        return $query->where('deleted', '=', '0');
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