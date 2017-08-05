<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [
    'uses' => 'AuthController@getForm',
    'as' => 'login',
]);

Route::post('/user-register', [
    'uses' => 'AuthController@processRegister',
    'as' => 'user.register',
]);

Route::post('/user-login', [
    'uses' => 'AuthController@login',
    'as' => 'user.login',
]);

Route::get('{provider}/auth', [
    'uses' => 'SocialAuthController@auth',
    'as' => 'social.auth',
]);

Route::get('/{provider}/redirect', [
    'uses' => 'SocialAuthController@auth_callback',
    'as' => 'social.callback',
]);

Route::get('logout', [
    'uses' => 'AuthController@logout',
    'as' => 'logout',
]);

Route::group(['prefix' => 'user', 'middleware' => 'auth'], function() {
    Route::get('/dashboard', [
        'uses' => 'UsersController@index',
        'as' => 'dashboard',
    ]);

    Route::post('/password-update', [
        'uses' => 'UsersController@passUpdate',
        'as' => 'pass_update',
    ]);

    Route::post('/post-create', [
        'uses' => 'PostsController@create',
        'as' => 'post.create',
    ]);

    Route::get('/all-groups', [
        'uses' => 'GroupsController@index',
        'as' => 'groups',
    ]);

    Route::get('/group-create', [
        'uses' => 'GroupsController@create',
        'as' => 'group.create',
    ]);

    Route::post('/group-process', [
        'uses' => 'GroupsController@store',
        'as' => 'process.create',
    ]);

    Route::get('/my-groups', [
        'uses' => 'GroupsController@myGroup',
        'as' => 'my.group',
    ]);

    Route::get('/show/group/{slug}', [
        'uses' => 'GroupsController@groupSingle',
        'as' => 'show.group',
    ]);
});
