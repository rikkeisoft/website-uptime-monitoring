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

//route alert-group
Route::resource('/alert-group','AlertGroupController');
//route deleted alert-group
Route::post('/alert-group/destroyAlertGroup','AlertGroupController@destroyAlertGroup')->name('destroyAlertGroup');
//route update alert-group
Route::post('/alert-group/updateAlertGroup','AlertGroupController@updateAlertGroup')->name('updateAlertGroup');
//route return view edit
Route::get('/alert-group/edit/{id}', 'AlertGroupController@edit');

