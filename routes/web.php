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

Route::get('/', 'Auth\LoginController@home');

// Static Pages
// TODO: ask if this is the correct use of Route::view()
Route::view('team', 'pages/team')->name('team');
Route::view('regulations', 'pages/regulations')->name('regulations');

// Posts
Route::get('posts/{id}', 'PostController@show');
Route::get('posts', 'PostController@showCreateForm');
Route::get('posts/{id}/edit', 'PostController@showEditForm');
Route::post('posts', 'PostController@create')->name('create');
Route::post('posts/{id}', 'PostController@edit');

//User
Route::get('users/{id}', 'UserController@showProfile');


// Cards
// Route::get('cards', 'CardController@list');
// Route::get('cards/{id}', 'CardController@show');

//API
// Route::put('api/cards', 'CardController@create');
// Route::delete('api/cards/{card_id}', 'CardController@delete');
// Route::put('api/cards/{card_id}/', 'ItemController@create');
// Route::post('api/item/{id}', 'ItemController@update');
// Route::delete('api/item/{id}', 'ItemController@delete');
Route::post('api/posts/{id}/stars','PostController@star');

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
