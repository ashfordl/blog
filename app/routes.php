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

Route::controller('user', 'UserController');