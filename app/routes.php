<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return Redirect::route('blog');
});

Route::get('blog', array(
    'as' => 'blog',
    'uses' => 'BlogController@getIndex'
    ));

Route::get('blog/list', array (
    'as' => 'bloglist',
    'uses' => 'BlogController@getList'
    ));

Route::get('blog/{id}/{title?}', array(
    'as' => 'blogpost',
    'uses' => 'BlogController@getPost'
    ))
    ->where('id', '[0-9]+');


Route::get('user/login', array(
    'as' => 'login',
    'uses' => 'UserController@getLogin'
    ));

Route::post('user/login', array(
    'as' => 'p_login',
    'uses' => 'UserController@postLogin'
    ));

Route::get('user/logout', array(
    'as' => 'logout',
    'uses' => 'UserController@getLogout'
    ));

Route::get('user/register', array(
    'as' => 'register',
    'uses' => 'UserController@getRegister'
    ));

Route::post('user/register', array(
    'as' => 'p_register',
    'uses' => 'UserController@postRegister'
    ));

Route::get('user/settings', array(
    'as' => 'settings',
    'uses' => 'UserController@getSettings'
    ));

Route::post('user/settings', array(
    'as' => 'p_settings',
    'uses' => 'UserController@postSettings'
    ));