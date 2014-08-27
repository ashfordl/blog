<?php

class Tag extends Eloquent
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
     * The relationship Tag belongs to many Blogpost.
     *
     * @return HasMany
     */
    public function blogposts()
    {
        return $this->belongsToMany('Blogpost');
    }
}