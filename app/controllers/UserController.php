<?php

class UserController extends BaseController {

    public function __construct()
    {
        $this->beforeFilter('auth', array('except' => array('getLogin', 'postLogin', 'getRegister')));
        $this->beforeFilter('guest', array('only' => array('getLogin', 'postLogin', 'getRegister')));
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
            'email'     => 'email|required',
            'password'  => 'min:5|required'
            );
        $validator = Validator::make($data, $rules);

        if($validator->fails())
        {
            // Validation fails, do not query database
            return Redirect::route('login')->withErrors($validator);
        }
        
        // Validation passes, proceed to query database
        if (Auth::attempt(array('email' => $data['email'], 'password' => $data['password']), 
            (isset($data['permanent']) && $data['permanent']) ))
        {
            return Redirect::route('blog');
        }
        else   // Auth failed
        {
            return Redirect::route('login')->with('login_error', true);
        }
    }

    function getLogout()
    {
        Auth::logout();
        return Redirect::route('blog');
    }

    public function getRegister()
    {   
        return View::make('register');
    }

    public function postRegister()
    {   
        return View::make('register');
    }
}