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

/*  Refrences/Notes

    *Hello World*
Route::get('/hello', function () {
    return '<h1> Hello World </h1>';
});

    *Passing dynamic values*
Route::get('/users/{name}/{id}', function ($name, $id) {
    return 'This is user '.$name. ' with an id of '.$id;
});

NB:
Never return views from Routes, use controllers instead. eg...

Route::get('/about', function () {
    return view('pages.about');
});

*/

Route::get('/laravel', function () {
    return view('welcome');
});

Route::get('/', 'PagesController@index');

Route::get('/about', 'PagesController@about');

Route::get('/services', 'PagesController@services');

//Creates all the routes for the functions created
Route::resource('posts', 'PostsController');

//Auto-added after activating authentication
Auth::routes();

Route::get('/dashboard', 'DashboardController@index') -> name('dashboard');
