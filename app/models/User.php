<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {
    /**
     * The validation rules to login.
     *
     * @var array
     */
    protected static $loginRules = array(
            'email'     => 'max:255|email|required',
            'password'  => 'min:5|required'
        );

    /**
     * The validation rules to register.
     *
     * @var array
     */
    protected static $regRules = array(
            'name'      => 'max:255|required|regex:/^[a-zA-Z0-9- _]*$/',
            'email'     => 'max:255|email|required|confirmed|unique:users,email',
            'password'  => 'min:5|required|confirmed'
        );

    /**
     * The validation rules to update the name.
     *
     * @var array
     */
    protected static $nameRules = array(
            'name'  => 'max:255|regex:/^[a-zA-Z0-9- _]*$/'
        );

    /**
     * The validation rules to update the password.
     *
     * @var array
     */
    protected static $passRules = array(
            'cur_password'  => 'passcheck|required',
            'new_password'  => 'required|min:5|confirmed'
        );

    /**
     * Attempts to login a user with passed data.
     *
     * @return bool
     */
    public static function attemptLogin($data)
    {
        // Validate input
        $validator = Validator::make($data, User::$loginRules);

        if ($validator->fails())
        {
            // Invalid input
            return false;
        }

        // Input is valid, attempt auth
        if (Auth::attempt(array('email' => $data['email'], 'password' => $data['password']), 
            (isset($data['permanent']) && $data['permanent']) ))
        {
            // Successful login
            return true;
        }
        else
        {
            // Error
            return false;
        }
    }

    /**
     * The validator last used to register a user.
     *
     * @var Validator
     */
    public static $registerValidator;

    /**
     * Attempts to register a user with passed data.
     *
     * @return bool
     */
    public static function attemptRegister($data)
    {
        // Validate input
        $validator = Validator::make($data, User::$regRules);

        if ($validator->fails())
        {
            // Invalid input
            User::$registerValidator = $validator;
            return false;
        }
        else
        {
            // Create a new user
            $user = new User();
            $user->display_name = Input::get('name');
            $user->email = Input::get('email');
            $user->password = Hash::make(Input::get('password'));
            $user->save();

            // Log him in
            Auth::login($user);

            // Set validator
            User::$registerValidator = $validator;
            return true;
        }
    }

    /**
     * The validator last used to update the user's name.
     *
     * @var Validator
     */
    public static $updateNameValidator;

    /**
     * Attempts to update the user's name.
     *
     * @return bool
     */
    public static function attemptUpdateName($data)
    {
        // Valdiate input
        $validator = Validator::make($data, User::$nameRules);

        if ($validator->passes())
        {
            // Valid input; update the name
            $user = Auth::user();
            $user->display_name = $data['name'];
            $user->save();

            // Set validator
            User::$updateNameValidator = $validator;
            return true;
        }
        else
        {
            // Invalid input
            User::$updateNameValidator = $validator;
            return false;
        }
    }

    /**
     * The validator last used to update the user's password.
     *
     * @var Validator
     */
    public static $updatePasswordValidator;

    /**
     * Attempts to update the user's password.
     *
     * @return bool
     */
    public static function attemptUpdatePassword($data)
    {
        // Valdiate input
        $validator = Validator::make($data, User::$passRules);

        if ($validator->passes())
        {
            // Valid input; update the password
            $user = Auth::user();
            $user->password = Hash::make(Input::get('new_password'));
            $user->save();

            // Set validator
            User::$updatePasswordValidator = $validator;
            return true;
        }
        else
        {
            // Invalid input
            User::$updatePasswordValidator = $validator;
            return false;
        }
    }

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

    public function isAdmin()
    {
        if ($this->id == 1)
            return true;
        return false;
    }

    public function isBanned()
    {
        $bans = $this->receivedBans()->get();

        foreach ($bans as $ban) 
        {
            if ($ban->end > new DateTime())
                return true;
            if (is_null($ban->end))
                return true;
        }

        return false;
    }

    public function receivedBans()
    {
        return $this->hasMany('Ban', 'user');
    }

    public function issuedBans()
    {
        return $this->hasMany('Ban', 'issued_by');
    }
}