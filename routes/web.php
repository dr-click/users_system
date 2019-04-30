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

Route::get('/', 'HomeController@index')->name('home');
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
  Route::resource('users', 'UsersController');
  Route::resource('groups', 'GroupsController', ['only' => [
    'index', 'create', 'store', 'destroy'
  ]]);
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
