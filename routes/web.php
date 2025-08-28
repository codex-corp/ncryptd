<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => 'auth'], function () {
    // Admin Dashboard
    Route::get('admin', ['as' => 'dashboard', 'uses' => 'CpanelController@getDashboard']);

    Route::group([
        'prefix' => 'admin',
        'namespace' => 'Cpanel',
        'as' => 'admin::',
        'middleware' => 'auth',
    ], function () {
        Route::get('project/history', ['uses' => 'ProjectController@history']);

        Route::resource('project', 'ProjectController');
        Route::post('project/analyze', ['uses' => 'ProjectController@analyze']);
        Route::post('project/check_syntax', ['uses' => 'ProjectController@check']);

        Route::post('project/exclude_process', function () {
            MagicalTrait::setExcluded();
        });

        Route::post('chat/getUserConversation', 'ChatController@getUserConversation');
        Route::post('chat/addMessageToConversation', 'ChatController@addMessageToConversation');
        Route::post('chat/getOnline', 'ChatController@getOnline');
        Route::post('chat/getChat', 'ChatController@getChat');
    });
});

Route::post('ncrypt_upload', ['as' => 'upload', 'uses' => 'Nand\MagicalHelpers@postUpload']);

Route::get('start', ['uses' => 'MagicalController@run']);
Route::post('bye', ['as' => 'bye', 'uses' => 'MagicalController@process']);

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

Route::group(['prefix' => 'auth'], function () {
    Route::get('/', ['uses' => 'AuthController@getSignin'])->middleware('guest');

    // Login
    Route::get('signin', ['as' => 'signin', 'uses' => 'AuthController@getSignin']);
    Route::post('signin', 'AuthController@postSignin');

    Route::get('linkedin', ['as' => 'linkedin', 'uses' => 'AuthController@loginWithLinkedin']);
    Route::get('github', ['as' => 'github', 'uses' => 'AuthController@loginWithGithub']);
    Route::get('google', ['as' => 'google', 'uses' => 'AuthController@loginWithGoogle']);

    // Register
    Route::get('signup', ['as' => 'signup', 'uses' => 'AuthController@getSignup']);
    Route::post('signup', 'AuthController@postSignup');

    // Logout
    Route::get('logout', ['as' => 'logout', 'uses' => 'AuthController@getLogout']);
});

Route::get('get/{dir}/{file}', function ($dir, $file) {
    return Response::download(base_path().'/projects/'.$dir.'/'.$file, $file, ['content-type' => 'application/zip']);
});

//Route::get('home', 'HomeController@index');
