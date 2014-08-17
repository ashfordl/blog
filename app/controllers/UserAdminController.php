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
            ->with('user', $user)
            ->with('errors', Session::get('errors'));
    }

    public function postBan()
    {
        if (Ban::attemptBan(Input::all()))
        {
            // Ban successful
            return Redirect::action('UserAdminController@getView', intval(Input::get('user')));
        }
        else
        {
            // Ban unsuccessful
            return Redirect::action('UserAdminController@getView', intval(Input::get('user')))
                        ->withErrors(Ban::$banValidator)
                        ->withInput();
        }
    }

    public function postUpdateBan()
    {
        $data = Input::all();
        $rules = array(
                'action'    =>  'required|in:cancel,extend',
                'user_id'   =>  'required|exists:users,id',
                'length'    =>  'required_if:action,extend|numeric|min:-1'
            );
        $validator = Validator::make($data, $rules);

        if ($validator->fails())
        {
            // If data is invalid, return status 400
            return Response::make('Poor data', 400);
        }

        // The user to update
        $ban = User::find($data['user_id'])->getCurrentBan();

        if (is_null($ban))
        {
            // Specified user has no current bans, return status 400
            return Response::make('User has no current bans', 400);
        }

        if ($data['action'] == 'cancel')
        {
            $ban->valid = false;
            $ban->save();

            $json = array(
                'ban'=> array(
                    'id' => $ban->id,
                    'valid' => $ban->valid,
                    'end' => $ban->end
                ),
                'html' => View::make('admin.user.helpers.ban-form')
                    ->with('user', User::find($data['user_id']))->render()
            );

            return Response::json($json);
        }

        if ($data['action'] == 'extend')
        {
            if ($data['length'] == -1)
                $ban->makePermanent();
            else
                $ban->extend($data['length']);

            $json = array(
                'ban'=> array(
                    'id' => $ban->id,
                    'valid' => $ban->valid,
                    'end' => $ban->end
                ),
                'html' => View::make('admin.user.helpers.banned-message')
                    ->with('user', User::find($data['user_id']))->render()
            );

            return Response::json($json);
        }
    }
}