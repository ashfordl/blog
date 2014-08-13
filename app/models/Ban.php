<?php

class Ban extends Eloquent
{
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

        if ($validator->fails())
        {
            // Invalid input
            Ban::$banValidator = $validator;
            return false;
        }
        else
        {
            // Create a new ban
            $ban = new Ban();
            $ban->user = $data['user'];
            $ban->issued_by = Auth::user()->id;
            $ban->start = new DateTime();
            if ($data['length'] == '-1')
                $ban->end = null;
            else
            {
                $now = new DateTime();
                $now->add(new DateInterval('P'.$data['length'].'D'));

                $ban->end = $now;
            }
            $ban->comment = $data['comment'];
            $ban->save();

            // Set validator
            Ban::$banValidator = $validator;
            return true;
        }
    }

    public function user()
    {
        return $this->belongsTo('User', 'user');
    }

    public function issuer()
    {
        return $this->belongsTo('User', 'issued_by');
    }

     public function scopeValid($query)
    {
        return $query->where('valid', '=', '1');
    }

    public function isPermanent()
    {
        return is_null($this->end);
    }

    public function makePermanent()
    {
        $this->end = null;
        $this->save();
    }

    public function extend($days)
    {
        if (is_null($this->end))
            return;

        $date = new DateTime($this->end);
        $date->add(new DateInterval('P'.$days.'D'));

        $this->end = $date;
        $this->save();
    }
}