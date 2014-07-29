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

// Filter all id patterns
Route::pattern('id', '\d+');

// GET / Redirect Index
Route::get('', function()
{
	return Redirect::route('blog');
});

// GET blog/list Blog Home
Route::get('blog', array(
    'as' => 'blog',
    'uses' => 'BlogController@getIndex'
    ));

// GET blog/list Blog Archive
Route::get('blog/list', array (
    'as' => 'bloglist',
    'uses' => 'BlogController@getList'
    ));

// GET blog/[num]/[...] 
Route::get('blog/{id}/{title?}', array(
    'as' => 'blogpost',
    'uses' => 'BlogController@getPost'
    ));

// REST user/* All user related actions
Route::controller('user', 'UserController');

// GET admin Admin home page
Route::get('admin', array(
    'as' => 'admin',
    'before' => 'admin',
    function ()
    {
        return View::make('admin.index');
    }));
    
// REST admin/blog/* Blog admin actions
Route::controller('admin/blog', 'BlogAdminController');