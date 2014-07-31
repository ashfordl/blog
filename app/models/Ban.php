<?php

class Ban extends Eloquent
{
    public function user()
    {
        return $this->belongsTo('User', 'user');
    }

    public function issuer()
    {
        return $this->belongsTo('User', 'issued_by');
    }

    public function type()
    {
        return $this->belongsTo('Bantype', 'type');
    }
}