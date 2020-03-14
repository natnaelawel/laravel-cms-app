<?php

use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', "WelcomeController@index")->name('home');
// Route::get('/posts/{post}',[PostsController::class,'show']);
Route::get('blog/posts/{post}','PostsController@show')->name("blog.show");

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// with the help of resource

// we can group middleware routes together using
// Route::middleware(['auth'])->group(function(){
//  then all routes like below
//})

Route::resource('categories', 'CategoriesController');
Route::resource('tags', 'TagsController')->middleware('auth');
Route::get('posts/trashed', 'PostController@trashed')->name('trashed-post.index');
Route::put('posts/trashed/{post}', 'PostController@restore')->name('trashed-post.restore');
// Route::resource('posts', 'PostController');
Route::resource('posts', 'PostController')->middleware(['auth']);

Route::middleware(['auth', 'admin'])->group(function(){
    Route::put('users/profile', 'UsersController@update')->name('users.update-profile');
    Route::get('users/profile', 'UsersController@edit')->name('users.edit-profile');
    Route::get('users', 'UsersController@index')->name('users.index');
    Route::put('users/{user}/make-admin', 'UsersController@makeAdmin')->name('users.make-admin');
});

