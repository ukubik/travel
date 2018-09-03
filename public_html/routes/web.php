<?php

Route::get('/', 'IndexController@index')->name('index');
// Show article
Route::get('/article/{id}', 'ArticleController@show')->name('article.show');
//Пользовательское соглашение
Route::get('/rules', 'IndexController@rules')->name('rules');
//Политика конфидециальности
Route::get('/privacypolicy', 'IndexController@privacypolicy')->name('privacypolicy');
//Контакты
Route::get('/contacts', 'IndexController@contacts')->name('contacts');
// Страница категории с оглавлением и статьями
Route::get('/category/{category}', 'CategoryController@index')->name('category');

//Send message admins
Route::post('/sendmessage', 'IndexController@sendmessage')->name('sendmessage');

// Получение рандомных статей в раздел интересное (компонент NowReadingComponent)
Route::get('/get-random-art', 'ArticleController@getRandomArt');

// Вывод рандомной статьи в блок на главной странице (SecondComponrnt.vue)
Route::get('rnd-article', 'ArticleController@rndArticle');

// Вывод комментариев к статье (секция зарегистрированных пользователей)
Route::group(['prefix' => 'comment', 'middleware' => ['auth']], function() {
  // Создание комментария
  Route::post('/create/{article}', 'CommentController@store');
  // Изменение комментария
  Route::put('/update/{comment}', 'CommentController@update');
  // Удаление комментария
  Route::delete('/destroy/{comment}', 'CommentController@destroy');
});



Route::group(['prefix' => 'user', 'middleware' => ['auth']], function() {
  // Получение пользователя в компонент модального окна для идентификации и вывода логина
  Route::get('/get-user', 'UserController@getUser');
  // Получение роли пользователя в компонент модального окна для идентификации и вывода логина
  Route::get('/get-role', 'UserController@getRole');
  // Редактирование профиля юзверя
  Route::post('/profile/{user}', 'UserController@updateProfile');
  // Подписка
  Route::put('/subscrybe/{user}', 'UserController@subscrybe');
  // Подача заявки на размещение статьи
  Route::get('/new-autor/{user}', 'Autor\ArticleController@newAuthor');
  //Заявка на асторство, прием сервером
  Route::post('/new-autor', 'Autor\ArticleController@newClaim')->name('user.new.autor');
});

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
  // Контроллер ресурса статей
  Route::post('/img-article/{article}', 'Admin\ArticleController@updateImg'); // Добавление превью фото к статье
  Route::put('/article/del-img', 'Admin\ArticleController@delImg'); // Удаление превью фото
  Route::get('/get-article/{category}', 'Admin\ArticleController@index')->name('admin.article.index'); // Получение статей по категориям
  Route::patch('/article/published/', 'Admin\ArticleController@published');  // Публикация статьи
  Route::resource('/article', 'Admin\ArticleController', [
    'except' => ['index'],
    'names' => [
      // 'index' => 'admin.article.index',
      'create' => 'admin.article.create',
      'store' => 'admin.article.store',
      'show' => 'admin.article.show',
      'edit' => 'admin.article.edit',
      'update' => 'admin.article.update',
      'destroy' => 'admin.article.destroy'
    ]
  ]);
  // Контроллер ресурса метатегов статей
  Route::resource('/metatag', 'Admin\MetaTagController', [
    'names' => [
      'index' => 'admin.metatag.index',
      'create' => 'admin.metatag.create',
      'store' => 'admin.metatag.store',
      'show' => 'admin.metatag.show',
      'edit' => 'admin.metatag.edit',
      'update' => 'admin.metatag.update',
      'destroy' => 'admin.metatag.destroy'
    ]
  ]);
  // Ресурс обработки комментариев к статьям
  Route::resource('/comment', 'Admin\CommentController', ['only' => ['index', 'update', 'destroy']]);
  // Guest message Controller
  Route::get('/get-messages', 'Admin\GuestMessageController@getMessages'); // Возвращает гостевые сообщения в компонент
  Route::delete('/destroy-all', 'Admin\GuestMessageController@destroyAll'); // удаление всех сообщений
  Route::resource('/guestmessage', 'Admin\GuestMessageController', ['only' => ['index', 'destroy']]);

  // Ресурс обработки заявок
  Route::resource('/claims', 'Admin\ClaimAuthorController', ['only' => ['index', 'update', 'destroy']]);
});
