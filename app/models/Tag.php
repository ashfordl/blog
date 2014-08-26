<?php

class Tag extends Eloquent
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
        return $this->belongsToMany('Blogpost');
    }
}