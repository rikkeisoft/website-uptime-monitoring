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
//route alert method of a group
Route::resource('/alert-method-of-group','AlertMethodAlertGroupController');

//route deleted alert method of a group
Route::post('/alert-method-of-group/destroy-Method-of-Group','AlertMethodAlertGroupController@destroyMethodofGroup')->name('destroyMethodofGroup');

////route edit alert method of a group
Route::post('/alert-method-of-group/update-Method-of-Group','AlertMethodAlertGroupController@updateMethodofGroup')->name('updateMethodofGroup');