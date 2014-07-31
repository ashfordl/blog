<?php

class Bantype extends Eloquent
{
    public $timestamps = false;

    public function bans()
    {
        return $this->hasMany('Ban', 'type');
    }
}