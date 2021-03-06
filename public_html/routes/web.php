<?php

Route::get('sitemap.xml', 'SitemapController@index');

Route::get('sitemap-articles', 'SitemapController@articles');

Route::get('sitemap-categories', 'SitemapController@categories');

Route::get('sitemap-attachment', 'SitemapController@attachment');

Route::get('/attachment/{article}/{img_puth}', 'IndexController@attachment')->where('img_puth', '.*');

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
Route::get('/category/{category}/{subcategory?}', 'CategoryController')->name('category');

//Send message admins
Route::post('/sendmessage', 'IndexController@sendmessage')->name('sendmessage');

// Получение рандомных статей в раздел интересное (компонент NowReadingComponent)
Route::get('/get-random-art/{article_id?}', 'ArticleController@getRandomArt');

// Вывод рандомной статьи в блок на главной странице (SecondComponrnt.vue)
Route::get('rnd-article', 'ArticleController@rndArticle');

// Вывод комментариев к статье (секция зарегистрированных пользователей)
// Route::group(['prefix' => 'comment', 'middleware' => ['auth']], function() {
  // Создание комментария
  Route::post('/comment/create/{article}', 'CommentController@store');
  // Изменение комментария
  Route::put('/comment/update/{comment}', 'CommentController@update');
  // Удаление комментария
  Route::delete('/comment/destroy/{comment}', 'CommentController@destroy');
// });

// Вывод последних трех комментариев
Route::get('/last-comments', 'CommentController@lastComments');


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

// Ресурс для работы со статьями авторов
Route::resource('/userarticle', 'Autor\ArticlesController')->middleware(['auth', 'author']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Section ADMIN
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function() {

  Route::get('/', 'Admin\IndexController@index')->name('admin.index');
  // Преход к неопубликованным статьям
  Route::get('/articles/no-publish', 'Admin\IndexController@noPublish')->name('admin.articles.no-publish');
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
  // Ресурс обработки категoрий статей
  Route::resource('/categories', 'Admin\CategoryController', ['only' => ['index', 'store', 'update', 'destroy']]);
  // Обновление added_menu
  Route::put('/category/added_menu/{id}', 'Admin\CategoryController@updAddMenu');
  // Контроллер ресурса статей
  Route::post('/img-article/{article}', 'Admin\ArticleController@updateImg'); // Добавление превью фото к статье
  Route::put('/article/del-img', 'Admin\ArticleController@delImg'); // Удаление превью фото
  Route::get('/get-article/{category}/{subcategory?}', 'Admin\ArticleController@index')->name('admin.article.index'); // Получение статей по категориям
  Route::patch('/article/published/', 'Admin\ArticleController@published');  // Публикация статьи
  Route::put('/article/new-category/{article}', 'Admin\ArticleController@newCategory')->name('admin.new-category'); // Изменение категории статьи
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
  // Неопубликованные комменты
  Route::get('/comment/{published?}', 'Admin\CommentController@index')->name('comment.index');
  // Ресурс обработки комментариев к статьям
  Route::resource('/comment', 'Admin\CommentController', ['only' => ['update', 'destroy']]);
  // Guest message Controller
  Route::get('/get-messages', 'Admin\GuestMessageController@getMessages'); // Возвращает гостевые сообщения в компонент
  Route::delete('/destroy-all', 'Admin\GuestMessageController@destroyAll'); // удаление всех сообщений
  Route::resource('/guestmessage', 'Admin\GuestMessageController', ['only' => ['index', 'destroy']]);

  // Ресурс обработки заявок
  Route::get('/get-claims', 'Admin\ClaimAuthorController@getClaims'); // получение заявок в компоненте
  Route::resource('/claims', 'Admin\ClaimAuthorController', ['only' => ['index', 'update', 'destroy']]);
  // Ресурс обработки юзеров
  // Получение юзеров в компонент
  Route::get('/get-users', 'Admin\UserController@getUsers');
  Route::resource('/users', 'Admin\UserController', ['except' => ['create', 'store']]);
  // Ресурс обработки подкатегорий
  Route::get('/sub-category/{category_id}', 'Admin\SubCategoryController@index');
  Route::resource('/sub-category', 'Admin\SubCategoryController', ['only' => ['store', 'destroy']]);
});
