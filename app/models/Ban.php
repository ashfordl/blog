<?php

class Ban extends Eloquent
{

/**               **/
/** RELATIONSHIPS **/
/**               **/

    /**
     * The inverse relationship User has many Ban.
     *
     * This relationship reperesents the user that received the ban.
     * The issuer() relationship represents the admin that handed out
     * the ban.
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('User', 'user');
    }

    /**
     * The inverse relationship User has many Ban.
     *
     * This relationship reperesents the admin that handed out 
     * the ban. The user() relationship represents the user that
     * received the ban.
     *
     * @return BelongsTo
     */
    public function issuer()
    {
        return $this->belongsTo('User', 'issued_by');
    }





/**              **/
/** QUERY SCOPES **/
/**              **/

    /**
     * A scope to select only valid bans.
     */
     public function scopeValid($query)
    {
        return $query->where('valid', '=', '1');
    }





/**            **/
/** PROPERTIES **/
/**            **/

    /**
     * Whether the current ban is permanent.
     *
     * @return bool
     */
    public function isPermanent()
    {
        return is_null($this->end);
    }





/**         **/
/** ACTIONS **/
/**         **/

    /**
     * Forces the ban to become permanent.
     */
    public function makePermanent()
    {
        $this->end = null;
        $this->save();
    }

    /**
     * Extends the ban's end date by the specified number of days.
     *
     * @param int $days
     */
    public function extend($days)
    {
        if (is_null($this->end))
            return;

        $date = new DateTime($this->end);
        $date->add(new DateInterval('P'.$days.'D'));

        $this->end = $date;
        $this->save();
    }





/**            **/
/** VALIDATION **/
/**            **/

    /**
     * The validation rules to create a new ban.
     *
     * @var array
     */
    protected static $banRules = array(
            'user'  => 'integer|min:0|required|exists:users,id',
            'length' => 'integer|min:-1|required',
            'comment' => 'required|min:10|max:255'
        );

    /**
     * The validator last used to create a ban.
     *
     * @var Validator
     */
    public static $banValidator;

    /**
     * Attempts to create a new ban.
     *
     * @return bool
     */
    public static function attemptBan($data)
    {
        // Validate input
        $validator = Validator::make($data, Ban::$banRules);
        Ban::$banValidator = $validator;

        if ($validator->fails())
        {
            // Invalid input
            return false;
        }
        else
        { 
            // Create a new ban
            $ban = new Ban();

            // Set start time to now
            $ban->start = new DateTime();

            // Set end time to permanent (null), or now+x
            if ($data['length'] == '-1')
                $ban->end = null;
            else
            {
                $endDate = new DateTime();
                $endDate->add(new DateInterval('P'.$data['length'].'D'));

                $ban->end = $endDate;
            }

            // Set the comment
            $ban->comment = $data['comment'];

            // Set the user and issuer foreign keys
            $user = User::find($data['user']);
            $ban->issuer()->associate(Auth::user());
            $ban = $user->receivedBans()->save($ban);

            $ban->save();

            // Ban successful
            return true;
        }
    }
}