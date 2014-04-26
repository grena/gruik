<?php

Blade::setContentTags('{%', '%}');
Blade::setEscapedContentTags('{%%', '%%}');

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
	return View::make('front.home');
});

Route::get('admin/login', function()
{
    return View::make('admin.login');
});

Route::post('admin/login', ['uses' => 'AuthController@login']);

Route::group(array('prefix' => 'admin', 'before' => 'auth'), function()
{

    Route::get('/', ['uses' => 'AdminController@dashboard']);
    Route::get('/posts', ['uses' => 'PostController@all']);
    Route::get('/tags', ['uses' => 'TagController@all']);
    Route::get('/settings', ['uses' => 'SettingsController@view']);

});