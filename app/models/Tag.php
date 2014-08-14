<?php

class Tag extends Eloquent
{
    public function blogposts()
    {
        return $this->belongsToMany('Blogpost');
    }
}