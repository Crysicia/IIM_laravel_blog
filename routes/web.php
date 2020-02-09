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

Route::redirect('/', '/posts');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// -- Notes
// Shorthand for : 
// Route::get('/posts', 'PostController@index')->name('posts.index');
// Route::get('/posts/create', 'PostController@create')->name('posts.create');
// Route::post('/posts', 'PostController@store')->name('posts.store');
// Route::get('/posts/{post}', 'PostController@show')->name('posts.show');
// Route::get('/posts/{post}/edit', 'PostController@edit')->name('posts.edit');
// Route::put('/posts/{post}', 'PostController@update')->name('posts.update');
// Route::patch('/posts/{post}', 'PostController@update')->name('posts.update');
// Route::delete('/posts/{post}', 'PostController@destroy')->name('posts.destroy');
Route::resource('/posts', 'PostController');

Route::resource('posts.comments', 'CommentController', ['only' => ['store', 'destroy']]);
Route::resource('posts.likes', 'LikePostController', ['only' => ['store', 'destroy']]);
Route::resource('comments.likes', 'LikeCommentController', ['only' => ['store', 'destroy']]);
