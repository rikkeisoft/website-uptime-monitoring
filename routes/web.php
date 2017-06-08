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
Route::get('/dashboard','HomeController@showStatistics');

//Route active user
Route::get('/activate', 'Auth\RegisterController@activate');

//Route error activate
Route::get('/activate-error',function(){
    return view('template-activate-auth.active-error');
});

Route::get('/activate/successfully',function(){
    return view('template-activate-auth.active');
});
//Resource router website
Route::resource('websites', 'WebsitesController');

//Router delete list website
Route::delete('/websites/destroy', 'WebsitesController@destroy')->name('websites.destroy');
//router change status website
Route::post('/websites/set_status_website', 'WebsitesController@setEnableDisable')->name('setStatusWebsite');
//Router detail charts website
Route::get('/websites/{website_id}/stat', 'WebsitesController@charts')->name('websites.charts');


//Route for alert method of a group
Route::resource('/alert-method-of-group','AlertMethodAlertGroupController');

//Route for deleted alert method of a group
Route::delete('/alert-method-of-group/destroy','AlertMethodAlertGroupController@destroy')->name('alert-method-of-group.destroy');

// Routes for Alert Group
Route::resource('/alert-group','AlertGroupController');

Route::get('eloquent/array', 'AlertTestController@index');
Route::get('eloquent/array-data', 'AlertTestController@data');

// Route for mass delete Alert Group
Route::delete('/alert-group/destroyAlertGroup','AlertGroupController@destroy')->name('alert-group.destroy');

//Resource router alert method
Route::resource('alert-methods', 'AlertMethodsController');

Route::delete('/alert-methods/destroy', 'AlertMethodsController@destroy')->name('alert-methods.destroy');

Route::get('/user-profile','ProfileController@index')->name('user-profile.index');
Route::put('/user-profile','ProfileController@update')->name('user-profile.update');

