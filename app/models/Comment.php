<?php

class Comment extends Eloquent
{

/**               **/
/** RELATIONSHIPS **/
/**               **/

    public function blogpost()
    {
        return $this->belongsTo('Blogpost');
    }

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function parent()
    {
        return $this->belongsTo('Comment');
    }

    public function children()
    {
        return $this->hasMany('Comment');
    }
}