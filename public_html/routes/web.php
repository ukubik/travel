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

Route::get('/', 'IndexController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Section ADMIN
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function() {
  Route::get('/', 'Admin\IndexController@index')->name('admin.index');
  // Фото для главной страницы сайта
  Route::resource('/images', 'Admin\ImagesController');
});
