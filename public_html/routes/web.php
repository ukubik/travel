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
  // Фотографии для главной страницы сайта
  Route::resource('/images', 'Admin\ImagesController', ['only' => [
        'index', 'store', 'update', 'destroy', 'show'],
        'names' => [
        'index' => 'admin.images.index',
        'store' => 'admin.images.store',
        'update' => 'admin.image.update',
        'destroy' => 'admin.image.destroy',
        'show' => 'admin.image.show'
    ]]);
  // Получение каринок в компонент ImagesComponent
  Route::get('/get-images/{cat_id}', 'Admin\ImagesController@getImages');
  // Категории фотографий
  Route::resource('/img-categories', 'Admin\ImgCategoriesController', [
    'only' => ['index', 'store', 'update', 'destroy'],
    'names' => ['index' => 'admin.img-categories.index',
                'store' => 'admin.img-categories.store',
                'update' => 'admin.img-categories.update',
                'destroy' => 'admin.img-categories.destroy',
    ]]);
  // Ресурс обработки категрий статей
  Route::resource('/categories', 'Admin\CategoryController', ['only' => ['index', 'store', 'update', 'destroy']]);
  // Обновление added_menu
  Route::put('/category/added_menu/{id}', 'Admin\CategoryController@updAddMenu');
});
