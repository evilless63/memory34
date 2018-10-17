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

Route::group([
    'namespace' => '\Admin',
], function()
{
    Route::resource('admin/menu','MenuController');
    Route::resource('admin/page','PageController');
    Route::resource('admin/album','AlbumsController');
    Route::resource('admin/image','ImagesController')->except(['create']);

    Route::get('admin/information/edit/', 'InformationController@editInfo')->name('information.edit');
    Route::post('admin/information/update/', 'InformationController@update')->name('information.update');

    Route::get('admin/image/create/{id}', 'ImagesController@create')->name('image.create');
    Route::post('admin/image/move/', 'ImagesController@postMove')->name('image.move');
    Route::post('admin/page/albumDetach/', 'PageController@detachAlbum')->name('page.albumdetach');

    Route::post('/admin/page/upload-image', 'PageController@uploadImage');

    Route::post('admin/mail/send', 'MailController@send')->name('mail.send');

    Route::get('/admin/user/edit', 'UserController@editProfile')->name('user.edit');
    Route::post('/admin/user/changepass', 'UserController@changePassword')->name('user.changepass');

    Route::get('/admin', 'HomeController@index')->name('admin.home');
});

Route::get('/home', 'HomeController@index')->name('home');




