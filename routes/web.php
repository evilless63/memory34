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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::resource('menu','MenuController');
Route::resource('page','PageController');
Route::resource('album','AlbumsController');

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/admin/page/upload-image', 'PageController@uploadImage');
