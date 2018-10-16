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

Route::get('information/edit/', 'InformationController@editInfo')->name('information.edit');
Route::post('information/update/', 'InformationController@update')->name('information.update');

Route::get('image/create/{id}', 'ImagesController@create')->name('image.create');
Route::post('image/move/', 'ImagesController@postMove')->name('image.move');
Route::post('page/albumDetach/', 'PageController@detachAlbum')->name('page.albumdetach');

// Route::post('/admin/image/create/{id}', array('as' => 'create','uses' => 'ImagesController@create'));

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/admin/page/upload-image', 'PageController@uploadImage');

Route::post('mail/send', 'MailController@send')->name('mail.send');

Route::get('/admin/user/edit', 'UserController@editProfile')->name('user.edit');
Route::post('/admin/user/changepass', 'UserController@changePassword')->name('user.changepass');


