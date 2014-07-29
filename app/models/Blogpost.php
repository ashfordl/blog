<?php

class Blogpost extends Eloquent
{
    public function scopeVisible($query)
    {
        return $query->where('deleted', '=', '0');
    }
}