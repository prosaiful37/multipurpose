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

Route::get('/', 'App\Http\Controllers\frontEndController@homePage');
Route::get('/blog', 'App\Http\Controllers\frontEndController@blogPage');
Route::get('/blog-single', 'App\Http\Controllers\frontEndController@blogSingle');







Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Category Routes
Route::resource('post-category', 'App\Http\Controllers\CategoryController');
Route::get('post-category-edit/{id}', 'App\Http\Controllers\CategoryController@edit');
Route::post('post-category-update', 'App\Http\Controllers\CategoryController@update') ->name('category.update');
Route::get('post-category-unpublished/{id}', 'App\Http\Controllers\CategoryController@unpublishedCategory') -> name('category.unpublished');
Route::get('post-category-Published/{id}', 'App\Http\Controllers\CategoryController@PublishedCategory') -> name('category.Published');

//tag routes
Route::resource('tag','App\Http\Controllers\tagController');


//post routes
Route::resource('post','App\Http\Controllers\postController');
