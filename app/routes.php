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
Route::get('', array(
    'as' => 'home',
    function()
    {
	   return Redirect::action('BlogController@getIndex');
    }
));

// REST blog/* All blog related actions
Route::controller('blog', 'BlogController');

// REST user/* All user related actions
Route::controller('user', 'UserController');

// GET admin Admin home page
Route::get('admin', array(
    'as' => 'admin',
    'before' => 'admin',
    function ()
    {
        return View::make('admin.index');
    }
));
    
// REST admin/blog/* Blog admin actions
Route::controller('admin/blog', 'BlogAdminController');