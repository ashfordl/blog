<?php

class Category extends Eloquent
{
    public $timestamps = false;

    public function blogposts()
    {
        return $this->hasMany('Blogpost');
    }
}