<?php

class Tag extends Eloquent
{
    public $timestamps = false;

    public function blogposts()
    {
        return $this->belongsToMany('Blogpost');
    }
}