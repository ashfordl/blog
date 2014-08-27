<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Auth\Reminders\RemindableTrait;

class User extends Eloquent implements UserInterface, RemindableInterface 
{
    use UserTrait, RemindableTrait;

/**                   **/
/** LARAVEL VARIABLES **/
/**                   **/

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
    protected $hidden = array('password', 'remember_token');





/**               **/
/** RELATIONSHIPS **/
/**               **/

    /**
     * The relationship User has many Ban.
     *
     * This relationship reperesents the bans the user has received.
     * The issuedBans() relationship represents the bans the user has
     * dealt as an admin.
     *
     * @return HasMany
     */
    public function receivedBans()
    {
        return $this->hasMany('Ban', 'user');
    }

    /**
     * The relationship User has many Ban.
     *
     * This relationship reperesents the bans the user has issued.
     * The receivedBans() relationship represents the bans the user
     * has received themselves.
     *
     * @return HasMany
     */
    public function issuedBans()
    {
        return $this->hasMany('Ban', 'issued_by');
    }





/**            **/
/** PROPERTIES **/
/**            **/

    /**
     * Whether the user is an admin.
     *
     * @return bool
     */
    public function isAdmin()
    {
        if ($this->id == 1)
            return true;
        return false;
    }

    /**
     * Whether the user is currently banned.
     *
     * @return bool
     */
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

    /**
     * The Ban instance of the user's current ban.
     *
     * @return Ban
     */
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





/**            **/
/** VALIDATION **/
/**            **/

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
     * This variable is set only if the last user to attempt login with valid
     * input is currently banned.
     *
     * If the last login attempt was successful (and the user was not banned)
     * this will be set to null. If the user was banned, this will be that instance
     * of User.
     *
     * If a validation error occurs, this will be set to null.
     *
     * @var User
     */
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
     * The validation rules to update the name.
     *
     * @var array
     */
    protected static $nameRules = array(
            'name'  => 'max:255|min:2|regex:/^[a-zA-Z0-9- _]*$/'
        );

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
     * The validation rules to update the password.
     *
     * @var array
     */
    protected static $passRules = array(
            'cur_password'  => 'passcheck|required',
            'new_password'  => 'required|min:5|confirmed'
        );

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
}