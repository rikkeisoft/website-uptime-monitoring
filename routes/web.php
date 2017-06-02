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

//Route for alert method of a group
Route::resource('/alert-method-of-group','AlertMethodAlertGroupController');

//Route for deleted alert method of a group
Route::post('/alert-method-of-group/destroy-Method-of-Group','AlertMethodAlertGroupController@destroyMethodOfGroup')->name('destroyMethodOfGroup');

//Route for error edit AlertMethodOfGroup
Route::get('/error-edit-alertMethodOfGroup',function (){
    return view('alert-method-of-group.error.error-edit');
});
// Route for error create AlertMethodOfGroup
Route::get('/error-create-alertMethodOfGroup',function (){
    return view('alert-method-of-group.error.error-create');
});
// Route for error delete AlertMethodOfGroup
Route::get('/error-delete-alertMethodOfGroup',function (){
    return view('alert-method-of-group.error.error-delete');
});