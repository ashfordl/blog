<?php

class Comment extends Eloquent
{

/**               **/
/** RELATIONSHIPS **/
/**               **/

    /**
     * The inverse relationship Blogpost has many Comment.
     *
     * @return HasMany
     */
    public function blogpost()
    {
        return $this->belongsTo('Blogpost');
    }

    /**
     * The inverse relationship User has many Comment.
     *
     * @return HasMany
     */
    public function user()
    {
        return $this->belongsTo('User');
    }

    /**
     * The inverse relationship Comment has many Comment.
     *
     * This relationship defines comment replies, and this function may
     * return null if the comment is not a reply.
     *
     * @return BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo('Comment');
    }

    /**
     * The relationship Comment has many Comment.
     *
     * This relationship defines replies. This function may return null
     * if the comment has no replies.
     *
     * @return HasMany
     */
    public function children()
    {
        return $this->hasMany('Comment');
    }
}