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
            'name'  => 'max:255|min:2|regex:/^[a-zA-Z0-9- _]*$/'
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

    public static $bannedUser = null;

    /**
     * Attempts to login a user with passed data.
     *
     * @return bool
     */
    public static function attemptLogin($data)
    {
        // Validate input
        $validator = Validator::make($data, User::$loginRules);
        User::$bannedUser = null;

        if ($validator->fails())
        {
            // Invalid input
            return false;
        }

        $loginData = array('email' => $data['email'], 'password' => $data['password']);
        $rememberMe = (isset($data['permanent']) && $data['permanent']);

        // Input is valid, attempt auth
        if (Auth::attempt($loginData, $rememberMe))
        {
            if (Auth::user()->isBanned())
            {
                User::$bannedUser = Auth::user();
                Auth::logout();
                return false;
            }
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
            $user->display_name = $data['name'];
            $user->email = $data['email'];
            $user->password = Hash::make($data['password']);
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
    public $updateNameValidator;

    /**
     * Attempts to update the user's name.
     *
     * @return bool
     */
    public function attemptUpdateName($data)
    {
        // Valdiate input
        $validator = Validator::make($data, User::$nameRules);

        if ($validator->passes())
        {
            // Valid input; update the name
            $this->display_name = $data['name'];
            $this->save();

            // Set validator
            $this->updateNameValidator = $validator;
            return true;
        }
        else
        {
            // Invalid input
            $this->updateNameValidator = $validator;
            return false;
        }
    }

    /**
     * The validator last used to update the user's password.
     *
     * @var Validator
     */
    public $updatePasswordValidator;

    /**
     * Attempts to update the user's password.
     *
     * @return bool
     */
    public function attemptUpdatePassword($data)
    {
        // Valdiate input
        $validator = Validator::make($data, User::$passRules);

        if ($validator->passes())
        {
            // Valid input; update the password
            $this->password = Hash::make($data['new_password']);
            $this->save();

            // Set validator
            $this->updatePasswordValidator = $validator;
            return true;
        }
        else
        {
            // Invalid input
            $this->updatePasswordValidator = $validator;
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

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    public function isAdmin()
    {
        if ($this->id == 1)
            return true;
        return false;
    }

    public function isBanned()
    {
        $bans = $this->receivedBans()->valid()->get();

        foreach ($bans as $ban) 
        {
            if (new DateTime($ban->end) >= new DateTime())
                return true;
            if (is_null($ban->end))
                return true;
        }

        return false;
    }

    public function getCurrentBan()
    {
        $bans = $this->receivedBans()->valid()->get();

        foreach ($bans as $ban) 
        {
            if (new DateTime($ban->end) >= new DateTime())
                return $ban;
            if (is_null($ban->end))
                return $ban;
        }
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