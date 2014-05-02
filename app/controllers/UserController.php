<?php

class UserController extends BaseController {

    public function __construct()
    {
        $this->beforeFilter('auth', array('except' => array('getLogin', 'postLogin', 'getRegister', 'postRegister')));
        $this->beforeFilter('guest', array('only' => array('getLogin', 'postLogin', 'getRegister', 'postRegister')));
        $this->beforeFilter('csrf', array('on' => 'post'));
    }

    public function getLogin()
    {
        return View::make('login')
                    ->with('nologin', true)
                    ->with('login_error', Session::get('login_error'));
    }

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
            return Redirect::route('login')
                        ->with('login_error', true)
                        ->withInput();
        }
        
        // Validation passes, proceed to query database
        if (Auth::attempt(array('email' => $data['email'], 'password' => $data['password']), 
            (isset($data['permanent']) && $data['permanent']) ))
        {
            return Redirect::route('blog');
        }
        else   // Auth failed
        {
            return Redirect::route('login')
                        ->with('login_error', true)
                        ->withInput();
        }
    }

    function getLogout()
    {
        Auth::logout();
        return Redirect::route('blog');
    }

    public function getRegister()
    {   
        return View::make('register')
                    ->with('nologin', true);
    }

    public function postRegister()
    {   
        $data = Input::all();
        $rules = array(
            'name'      => 'max:255|required|regex:/^[a-zA-Z0-9\- _]*$/',
            'email'     => 'max:255|email|required|confirmed|unique:users,email',
            'password'  => 'min:5|required|confirmed'
            );
        $validator = Validator::make($data, $rules);

        if($validator->fails())
        {
            // Validation fails, show errors
            return Redirect::route('register')
                        ->withErrors($validator)
                        ->withInput();
        }

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