<?php

class UserAdminController extends BaseController 
{
    public function __construct()
    {
        $this->beforeFilter('admin');
        $this->beforeFilter('csrf', array('on' => 'post'));
    }

    public function getIndex()
    {
        $users = User::all();

        return View::make('admin.user.index')
            ->with('users', $users);
    }

    public function getView($id)
    {
        $user = User::find($id);

        if (is_null($user))
        {
            App::abort(404);
        }

        return View::make('admin.user.user')
            ->with('user', $user);
    }
}