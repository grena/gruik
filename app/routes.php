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

Route::get('/', ['uses' => 'HomeController@home']);
Route::get('/view/{id}', ['uses' => 'HomeController@view']);

Route::get('admin/login', function()
{
    return View::make('admin.login');
});

Route::post('admin/login', ['uses' => 'AuthController@login']);

Route::group(array('prefix' => 'admin', 'before' => 'auth'), function()
{

    Route::get('/', ['uses' => 'PostController@edit']);
    Route::get('/posts', ['uses' => 'PostController@all']);
    Route::get('/tags', ['uses' => 'TagController@all']);
    Route::get('/settings', ['uses' => 'SettingsController@view']);

});

Route::group(array('prefix' => 'api', 'before' => 'csrf'), function()
{

    // Public API interface
    Route::resource('posts', 'API\PostController', array('only' => array('index', 'show')));

    // Admin API interface
    Route::group(array('before' => 'auth'), function()
    {
        Route::resource('posts', 'API\PostController', array('except' => array('index', 'show')));
    });

});