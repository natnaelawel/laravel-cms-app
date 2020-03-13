<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// with the help of resource

// we can group middleware routes together using
// Route::middleware(['aut'])->group(function(){
//  then all routes like below
//})

Route::resource('categories', 'CategoriesController');
Route::resource('tags', 'TagsController')->middleware('auth');
Route::get('posts/trashed', 'PostController@trashed')->name('trashed-post.index');
Route::put('posts/trashed/{post}', 'PostController@restore')->name('trashed-post.restore');
// Route::resource('posts', 'PostController');
Route::resource('posts', 'PostController')->middleware(['auth']);


