<?php

class Comment extends Eloquent
{

/**               **/
/** RELATIONSHIPS **/
/**               **/

    /**
     * The inverse relationship Blogpost has many Comment.
     *
     * @return BelongsTo
     */
    public function blogpost()
    {
        return $this->belongsTo('Blogpost');
    }

    /**
     * The inverse relationship User has many Comment.
     *
     * @return BelongsTo
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
        return $this->belongsTo('Comment', 'parent_id');
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
        return $this->hasMany('Comment', 'parent_id');
    }





/**            **/
/** VALIDATION **/
/**            **/

    /**
     * The validation rules for a comment.
     *
     * @var array
     */
    protected static $newRules = array(
            'text' => 'required|max:1000'
        );

    public static $newValidator;

    /**
     * Attempts to modify or create a comment.
     *
     * @return bool
     */
    public static function attemptNew($data, $id)
    {
        // Validate input
        $validator = Validator::make($data, Comment::$newRules);
        Comment::$newValidator = $validator;

        if ($validator->fails())
        {
            // Invalid input
            return false;
        }

        $comment = new Comment();
        $comment->blogpost_id = $id;
        $comment->user_id = Auth::user()->id;

        $comment->text = $data['text'];

        $comment->save();

        // Set validator
        return true;
    }
}