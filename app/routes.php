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
Route::get('/explore', ['uses' => 'HomeController@explore']);
Route::get('/view/{id}', ['uses' => 'PostController@view']);
Route::get('/login', ['uses' => 'HomeController@login']);
Route::get('/register', ['uses' => 'HomeController@register']);
Route::get('/forgot-password', ['uses' => 'HomeController@forgotPassword']);
Route::get('/password-reset/{token}', ['as' => 'passwordReseter', 'uses' => 'HomeController@passwordReset']);
Route::post('/forgot-password', ['uses' => 'AuthController@forgotPassword']);
Route::post('/reset-password', ['uses' => 'AuthController@resetPassword']);
Route::post('/login', ['uses' => 'AuthController@login']);
Route::post('/register', ['uses' => 'AuthController@register']);
Route::get('/logout', ['uses' => 'AuthController@logout']);

Route::group(array('before' => 'auth'), function()
{

    Route::get('/create', ['uses' => 'PostController@edit']);
    Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'PostController@dashboard']);
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
        Route::resource('users', 'API\UserController');
        Route::resource('posts', 'API\PostController', array('except' => array('index', 'show')));
        Route::post('posts/multiple_delete', ['uses' => 'API\PostController@multiple_delete']);
    });

});
