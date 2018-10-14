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
Route::resource('image','ImagesController')->except(['create']);

Route::get('image/create/{id}', 'ImagesController@create')->name('image.create');
Route::get('image/move/{id}', 'ImagesController@postMove')->name('image.move');

// Route::post('/admin/image/create/{id}', array('as' => 'create','uses' => 'ImagesController@create'));

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/admin/page/upload-image', 'PageController@uploadImage');


