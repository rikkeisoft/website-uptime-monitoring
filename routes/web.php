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

// Route administrator
Route::get('/home','HomeController@showStatistics');

//Route active user
Route::get('/activate', 'Auth\RegisterController@activate');

//Route error activate
Route::get('/activate-error',function(){
    return view('template-activate-auth.active-error');
});

Route::get('/activate/successfully',function(){
    return view('template-activate-auth.active');
});

// Routes for Alert Group
Route::resource('/alert-group','AlertGroupController');

// Route for mass delete Alert Group
Route::post('/alert-group/destroyAlertGroup','AlertGroupController@destroyAlertGroup')->name('destroyAlertGroup');

//resource router alert method
Route::resource('alertmethods', 'AlertMethodsController');

Route::post('/alertmethods/delete_alert_method', 'AlertMethodsController@deleteAlertMethods')->name('deleteAlertMethods');
