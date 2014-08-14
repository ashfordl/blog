<?php

class Category extends Eloquent
{
    public function blogposts()
    {
        return $this->hasMany('Blogpost');
    }
}