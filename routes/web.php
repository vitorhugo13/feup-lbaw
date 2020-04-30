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
Route::view('404', 'errors/404')->name('404');
Route::view('403', 'errors/403')->name('403');

// Posts
Route::get('posts/{id}', 'PostController@show');
Route::get('posts', 'PostController@showCreateForm');
Route::get('posts/{id}/edit', 'PostController@showEditForm')->name('edit');
Route::delete('posts/{id}', 'PostController@delete')->name('delete');
Route::post('posts', 'PostController@create')->name('create');
Route::post('posts/{id}', 'PostController@edit');

//User
Route::get('users/{id}', 'UserController@showProfile')->name('profile');
Route::get('users/{id}/edit', 'UserController@showEditProfile');
Route::post('users/{id}/edit/photo', 'UserController@changePhoto')->name('changePhoto');
Route::post('users/{id}/edit/bio', 'UserController@changeBio');
Route::post('users/{id}/edit/credentials', 'UserController@changeCredentials');

// Homepage
Route::view('home', 'pages/home')->name('home');

//API Stars
Route::post('api/posts/{id}/stars','PostController@star');
Route::delete('api/posts/{id}/stars','PostController@unstar');
Route::post('api/contents/{id}/votes', 'PostController@add');
Route::delete('api/contents/{id}/votes', 'PostController@remove');
Route::put('api/contents/{id}/votes', 'PostController@update');

//API Comments
Route::post('/api/comments', 'CommentController@create');
Route::get('/api/comments/{id}', 'CommentController@show');
Route::put('/api/comments/{id}', 'CommentController@edit');
Route::delete('/api/comments/{id}', 'CommentController@delete');

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
