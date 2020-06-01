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

Route::get('/', 'FeedController@showHome');

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

// Categories
Route::get('categories', 'CategoryController@show')->name('categories_page');

// Reports
Route::get('reports', 'ReportController@show')->name('reports');
Route::get('api/reports/posts', 'ReportController@getPosts');
Route::get('api/reports/comments', 'ReportController@getComments');
Route::get('api/reports/contests', 'ReportController@getContests');
Route::post('api/reports/{id}/contests', 'ReportController@contestReport');
Route::post('api/reports/contest/reasons', 'ReportController@getBlockReasons');
Route::post('api/reports/create', 'ReportController@createReport');
// Reports API
Route::delete('api/reports/{id}', 'ReportController@deleteReport');
Route::put('api/reports/{id}', 'ReportController@sortReport');

//User
Route::get('users/{id}', 'UserController@showProfile')->name('profile');
Route::get('users/{id}/edit', 'UserController@showEditProfile');
Route::post('users/{id}/edit/photo', 'UserController@changePhoto')->name('changePhoto');
Route::post('users/{id}/edit/bio', 'UserController@changeBio');
Route::post('users/{id}/edit/credentials', 'UserController@changeCredentials');
Route::delete('users/{id}', 'UserController@delete')->name('deleteProfile');

Route::post('api/notifications', 'UserController@getNotifications');

// Homepage, Feed & Search
Route::get('home', 'FeedController@showHome')->name('home');
Route::get('feed', 'FeedController@showFeed')->name('feed');
Route::post('search/{page}', 'SearchController@show');
Route::get('api/search/{page}/filter', 'SearchController@filter');

// API Profile
Route::post('api/delete/photo', 'UserController@deletePhoto');

//API User Management
Route::put('api/users/{id}/role', 'UserController@changePermissions');
Route::put('api/users/{id}/block', 'UserController@block');


// API Stars
Route::post('api/posts/{id}/stars','PostController@star');
Route::delete('api/posts/{id}/stars','PostController@unstar');
Route::post('api/categories/{id}/stars', 'CategoryController@star');
Route::delete('api/categories/{id}/stars', 'CategoryController@unstar');

// -----===== API CONTENT =====-----
Route::put('api/contents/{id}', 'ContentController@hide');
// API Rating
Route::post('api/contents/{id}/votes', 'ContentController@add');
Route::delete('api/contents/{id}/votes', 'ContentController@remove');
Route::put('api/contents/{id}/votes', 'ContentController@update');


// API Feed
Route::get('api/fresh/{page}', 'FeedController@fresh');
Route::get('api/hot/{page}', 'FeedController@hot');
Route::get('api/top/{page}', 'FeedController@top');
Route::get('api/filter/{selected_categories}/{page}', 'FeedController@filter');
Route::get('api/filter/{filters}/{page}', 'SearchController@filter');

//API Comments
Route::post('/api/comments', 'CommentController@create');
Route::get('/api/comments/{id}', 'CommentController@show');
Route::put('/api/comments/{id}', 'CommentController@edit');
Route::delete('/api/comments/{id}', 'CommentController@delete');

// API Category
Route::post('api/categories', 'CategoryController@create')->name('create_category');
Route::put('api/categories/{id}', 'CategoryController@edit')->name('edit_category');
Route::get('api/categories/{criteria}/{order}', 'CategoryController@order');
Route::post('api/posts/{id}/categories', 'PostController@move');

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
