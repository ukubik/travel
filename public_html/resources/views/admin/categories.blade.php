@extends('admin.layouts.main')

@section('content')

<div class="container-fluid">
  <div class="row my-4">
    <div class="col">
      <div class="container">
        <div class="alert alert-primary z-depth-2" role="alert">
          Для создания новой категории статей заполните форму ниже, нажмите "сохранить".
          Заполнять ВСЕ поля формы. Поле "ссылка на категорию" заполняется латиницей.
          Для изменения категории измените соответствующие поля в списке категорий, нажмите "изменить".
        </div>
      </div>
    </div>
  </div>

  <new-category></new-category>

  @if(isset($categories) && $categories->isNotEmpty())
  <div class="row text-center my-4 mx-1 border rounded bg-white">
    <div class="col p-2 border-right">
      Изображение <small class="text-muted">(карусель в заголовке сайта)</small>
    </div>
<!--     <div class="col p-2 border-right">
      Ссылка на категорию
    </div> -->
    <div class="col p-2 border-right">
      Наименование в меню
    </div>
    <div class="col p-2 border-right">
      Заголовок <small class="text-muted">(отображается в заголовке главной страницы)</small>
    </div>
    <div class="col p-2 border-right">
      Описание <small class="text-muted">(отображается в заголовке главной страницы)</small>
    </div>
    <div class="col p-2 border-right">
      Отображение в меню сайта
    </div>
    <div class="col p-2">
      Действие
    </div>
  </div>
  @foreach($categories as $category)

  <category-component :category="{{ json_encode($category) }}"></category-component>

  @endforeach
  <div class="row">
    <div class="col">
      {!! $categories->render() !!}
    </div>
  </div>
  @endif
</div>




@endsection
