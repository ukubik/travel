@extends('admin.layouts.main')

@section('content')

<div class="container-fluid">
  <div class="row my-4">
    <div class="col text-center">
      <h5>Сводная информация</h5>
    </div>
  </div>

  <div class="row pb-4 border-bottom">

    <div class="col-md-6 border-right">

      <div class="row">

        <div class="col-md-4 p-2 d-flex align-items-stretch">
          <div class="card w-100">
            <div class="card-body">
              <h5 class="card-title border-bottom">Всего статей на сайте</h5>
              <p class="card-text font-weight-bold">{{ $articles->count() }}</p>
              <a href="{{ route('admin.article.create') }}" title="Создать статью" class="btn btn-success">Новая статья</a>
            </div>
          </div>
        </div>

        <div class="col-md-4 p-2 d-flex align-items-stretch">
          <div class="card w-100">
            <div class="card-body">
              <h5 class="card-title border-bottom">Опубликовано</h5>
              <p class="card-text font-weight-bold">{{ $articles->where('published', 'Опубликована')->count() }}</p>
            </div>
          </div>
        </div>

        <div class="col-md-4 p-2 d-flex align-items-stretch">
          <div class="card w-100">
            <div class="card-body">
              <h5 class="card-title border-bottom">Не опубликовано</h5>
              <p class="card-text font-weight-bold">{{ $articles->where('published', 'Не опубликована')->count() }}</p>
              <a href="{{ route('admin.articles.no-publish') }}" class="btn btn-info">Перейти</a>
            </div>
          </div>
        </div>

      </div>

    </div>

    <div class="col-md-6">

      <div class="row">

        <div class="col-md-4 p-2 d-flex align-items-stretch">
          <div class="card w-100">
            <div class="card-body">
              <h5 class="card-title border-bottom">Всего комментариев</h5>
              <p class="card-text font-weight-bold">{{ $comments->count() }}</p>
              <a href="{{ route('comment.index') }}" title="Создать статью" class="btn btn-warning">Перейти</a>
            </div>
          </div>
        </div>

        <div class="col-md-4 p-2 d-flex align-items-stretch">
          <div class="card w-100">
            <div class="card-body">
              <h5 class="card-title border-bottom">Опубликовано</h5>
              <p class="card-text font-weight-bold">{{ $comments->where('published', 'Опубликован')->count() }}</p>
            </div>
          </div>
        </div>

        <div class="col-md-4 p-2 d-flex align-items-stretch">
          <div class="card w-100">
            <div class="card-body">
              <h5 class="card-title border-bottom">Не опубликовано</h5>
              <p class="card-text font-weight-bold">{{ $comments->where('published', 'Не опубликован')->count() }}</p>
              <a href="{{ route('comment.index', 'Не опубликован') }}" class="btn btn-default">Перейти</a>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>

  <div class="row pt-2 border-bottom text-center my-4">
    <div class="col">
      <p>Статьи по категориям</p>
    </div>
  </div>

  <div class="row mb-5">

    @if(isset($categories) && $categories->isNotEmpty())

    @foreach($categories as $category)

    <div class="col p-2 d-flex align-items-stretch">
      <div class="card w-100">
        <div class="card-body">
          <h6 class="card-title border-bottom">{{ $category->menu_name }}</h6>
          <p class="card-text">Всего статей в категории</p>
          <p class="card-text font-weight-bold">{{ $category->articles->count() }}</p>

          @php
          $articles = $category->articles->where('published', 'Опубликована')->sortBy(function($article, $key) {
            return $article['updated_at'];
          });
          @endphp

          Последняя опубликованная статья - <a href="{{ route('admin.article.show', $articles->values()->last()) }}">{{ $articles->values()->last()->title }}</a>
          <div class="card-footer">
            <a href="{{ route('admin.article.index', $category) }}" class="btn btn-default">Перейти к категории</a>
          </div>
        </div>
      </div>
    </div>

    @if($category->subcategories->isNotEmpty())

    @foreach($category->subcategories as $subcategory)

    <div class="col p-2 d-flex align-items-stretch">
      <div class="card w-100">
        <div class="card-body">
          <h6 class="card-title border-bottom">{{ $subcategory->title }}</h6>
          <p class="card-text">Всего статей в подкатегории</p>
          <p class="card-text font-weight-bold">{{ $subcategory->articles->count() }}</p>

          @php
          $articles = $subcategory->articles->where('published', 'Опубликована')->sortBy(function($article, $key) {
            return $article['updated_at'];
          });
          @endphp

          Последняя опубликованная статья - <a href="{{ route('admin.article.show', $articles->values()->last()) }}">{{ $articles->values()->last()->title }}</a>
          <div class="card-footer">
            <a href="{{ route('admin.article.index', [$category, $subcategory]) }}" class="btn btn-default">Перейти к подкатегории</a>
          </div>
        </div>
      </div>
    </div>

    @endforeach

    @endif

    @endforeach

    @endif

  </div>
</div>

@endsection
