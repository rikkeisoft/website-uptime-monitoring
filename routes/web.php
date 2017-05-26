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

// route administrator
Route::get('/home','HomeController@showStatistics');

//route active user
Route::get('/activate', 'Auth\RegisterController@activate');

//route notification
Route::get('/activate-error',function(){
    return view('template-activate-auth.active-error');
});

Route::get('/activate/successfully',function(){
    return view('template-activate-auth.active');
});


//router list website
Route::get('/websites/list', 'WebsitesController@index')->name('viewListWebsite');

//router add websites view
Route::get('/websites/add', 'WebsitesController@add')->name('viewAddWebsite');

//router edit websites view
Route::get('/websites/update/{id}', 'WebsitesController@update')->name('viewUpdateWebsite');

Route::post('/websites/add_website', 'WebsitesController@addWebsite')->name('addWebsite');
Route::post('/websites/update_website', 'WebsitesController@updateWebsite')->name('updateWebsite');
Route::post('/websites/delete_website', 'WebsitesController@deleteWebsite')->name('deleteWebsite');
