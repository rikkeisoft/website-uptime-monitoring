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

Auth::routes();

Route::get('/', function () {
    return view('v2/modules/intro/introduction');
});

// Route::get('/dashboard', 'HomeController@showStatistics');

// Route::get('/user-profile', 'ProfileController@index')->name('user-profile.index');
// Route::put('/user-profile', 'ProfileController@update')->name('user-profile.update');

// Route::get('/activate', 'Auth\RegisterController@activate');
// Route::get('/activate-error', function () {
//     return view('template-activate-auth.active-error');
// });
// Route::get('/activate/successfully', function () {
//     return view('template-activate-auth.active');
// });

// Route::resource('websites', 'WebsitesController');
// Route::delete('/websites/destroy', 'WebsitesController@destroy')->name('websites.destroy');
// Route::post('/websites/set_status_website', 'WebsitesController@setEnableDisable')->name('websites.toggle_status');
// Route::get('/websites/{website_id}/statistics', 'WebsitesController@statistics')->name('websites.statistics');

// Route::resource('/alert-group','AlertGroupController');
// Route::delete('/alert-group/destroyAlertGroup','AlertGroupController@destroy')->name('alert-group.destroy');

// Route::resource('alert-methods', 'AlertMethodsController');
// Route::delete('/alert-methods/destroy', 'AlertMethodsController@destroy')->name('alert-methods.destroy');

// Route::resource('/alert-method-of-group', 'AlertMethodAlertGroupController');
// Route::delete('/alert-method-of-group/destroy', 'AlertMethodAlertGroupController@destroy')->name('alert-method-of-group.destroy');
