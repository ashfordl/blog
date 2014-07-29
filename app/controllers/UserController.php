<?php

class UserController extends BaseController 
{

    /**
     * Constructor defines filters for actions within this controller.
     *
     * Defined filters are CSRF (for POST requests), guest (only for login and register) and auth (for all except login and register).
     */
    public function __construct()
    {
        $exceptions = array('getLogin', 'postLogin', 'getRegister', 'postRegister');
        $this->beforeFilter('auth', array('except' => $exceptions));
        $this->beforeFilter('guest', array('only'  => $exceptions));
        $this->beforeFilter('csrf', array('on' => 'post'));
    }

    /**
     * Displays and returns the login view.
     *
     * @return View:login
     */
    public function getLogin()
    {
        return View::make('user.login')
                    ->with('login_error', Session::get('login_error'));
    }

    /**
     * Validates and responds to POST requests to login
     * 
     * @return 302:blog | 302:login
     */
    public function postLogin()
    {
        $data = Input::all();
        $rules = array(
            'email'     => 'max:255|email|required',
            'password'  => 'min:5|required'
            );
        $validator = Validator::make($data, $rules);

        if($validator->fails())
        {
            // Validation fails, do not query database
            return Redirect::action('UserController@getLogin')
                        ->with('login_error', true)
                        ->withInput();
        }
        
        // Validation passes, proceed to query database
        if (Auth::attempt(array('email' => $data['email'], 'password' => $data['password']), 
            (isset($data['permanent']) && $data['permanent']) ))
        {
            // Login successful
            return Redirect::route('blog');
        }
        else
        {
            // Login unsuccessful
            return Redirect::action('UserController@getLogin')
                        ->with('login_error', true)
                        ->withInput();
        }
    }

    /**
     * Logs the user out
     *
     * @return 302:blog
     */
    function getLogout()
    {
        Auth::logout();
        return Redirect::route('blog');
    }

    /**
     * Displays and returns the login view.
     *
     * @return View:register
     */
    public function getRegister()
    {   
        return View::make('user.register');
    }

    /**
     * Validates and responds to POST requests to register
     * 
     * @return 302:blog | 302:register
     */
    public function postRegister()
    {   

        $rules = array(
            'name'      => 'max:255|required|regex:/^[a-zA-Z0-9- _]*$/',
            'email'     => 'max:255|email|required|confirmed|unique:users,email',
            'password'  => 'min:5|required|confirmed'
        );
        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails())
        {
            // Validation fails, show errors
            return Redirect::action('UserController@getRegister')
                        ->withErrors($validator)
                        ->withInput();
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

            return Redirect::route('blog');
        }
    }

    /**
     * Displays and returns the settings view.
     *
     * @return View:settings
     */
    public function getSettings()
    {
        return View::make('user.settings')
                ->with('user', Auth::user())
                ->with('errors', Session::has('errors') ? Session::get('errors') : array())
                ->with('successes', Session::has('successes') ? Session::get('successes') : array());
    }

    /**
     * Validates and responds to POST requests to change settings
     * 
     * @return 302:settings
     */
    public function postSettings()
    {
        $data = Input::all();

        $errors = array();
        $successes = array();

        // If the name has been changed
        if(Input::get('name') != Auth::user()->display_name)
        {
            $rules = array(
                'name'  => 'max:255|regex:/^[a-zA-Z0-9- _]*$/'
            );
            $validator = Validator::make($data, $rules);

            if($validator->passes())
            {
                $user = Auth::user();
                $user->display_name = Input::get('name');
                $user->save();
                array_push($successes, 'Display name changed successfully');
            }
            else   // If validation fails, add the error message to the array
                array_push($errors, $validator->messages()->first());
        }

        if(Input::get('cur_password') != '' || Input::get('new_password') != '')
        {
            $rules = array(
                'cur_password'  => 'passcheck|required',
                'new_password'  => 'required|min:5|confirmed'
            );
            $validator = Validator::make($data, $rules);

            if($validator->passes())
            {
                $user = Auth::user();
                $user->password = Hash::make(Input::get('new_password'));
                $user->save();
                array_push($successes, 'Password changed successfully');
            }
            else   // If validation fails, add the error message to the array
                array_push($errors, $validator->messages()->first());
        }

        return Redirect::action('UserController@getSettings')
                    ->with('errors', $errors)
                    ->with('successes', $successes);
    }

    /**
     * Validates and responds to POST requests to change the display name
     * 
     * @return JSON:response
     */
    public function postChangeUsername()
    {
        // TODO: Implement

        echo "hi";
    }

    /**
     * Validates and responds to POST requests to change the password
     * 
     * @return JSON:response
     */
    public function postChangePassword()
    {
        // TODO: Implement

        echo "hi";
    }
}