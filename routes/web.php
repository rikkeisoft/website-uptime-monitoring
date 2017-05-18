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
// route home
Route::get('/home', 'HomeController@index')->name('home');
//route active user
Route::get('/activeuser','Auth\RegisterController@active');

//route notification
Route::get('/error',function(){
    return view('notification.404');
});
Route::get('/active',function(){
    return view('notification.active');
});