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
Route::get('posts/{id}/edit', 'PostController@showEditForm')->name('edit');
Route::post('posts', 'PostController@create')->name('create');
Route::post('posts/{id}', 'PostController@edit');

//User
Route::get('users/{id}', 'UserController@showProfile');

//API Stars
Route::post('api/posts/{id}/stars','PostController@star');
Route::delete('api/posts/{id}/stars','PostController@unstar');
Route::post('api/contents/{id}/votes', 'PostController@add');
Route::delete('api/contents/{id}/votes', 'PostController@remove');
Route::put('api/contents/{id}/votes', 'PostController@update');
//API Comments
Route::post('/api/comments', 'CommentController@create'); //TODO: change A7
Route::get('/api/comments/{id}', 'CommentController@show');
Route::put('/api/comments/{id}', 'CommentController@edit');
Route::delete('/api/comments/{id}', 'CommentController@delete');

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
