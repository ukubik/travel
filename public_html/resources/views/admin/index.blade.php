@extends('admin.layouts.main')

@section('content')

<div class="container-fluid">
  <div class="row my-4">
    <div class="col text-center">
      <h5>Сводная информация</h5>
    </div>
  </div>

  <div class="row pb-4 border-bottom">
    <div class="col-md-6">
      <div class="row">
        <div class="col-md-4 p-2 d-flex align-items-stretch">
          <!-- Card -->
          <div class="card w-100">

            <!-- Card content -->
            <div class="card-body">

              <!-- Title -->
              <h5 class="card-title border-bottom">Всего статей на сайте</h5>
              <!-- Text -->
              <p class="card-text font-weight-bold">{{ $articles->count() }}</p>
              <!-- Button -->
              <a href="{{ route('admin.article.create') }}" title="Создать статью" class="btn btn-primary">Новая статья</a>

            </div>

          </div>
          <!-- Card -->
        </div>
        <div class="col-md-4 p-2 d-flex align-items-stretch">
          <!-- Card -->
          <div class="card w-100">

            <!-- Card content -->
            <div class="card-body">

              <!-- Title -->
              <h5 class="card-title border-bottom">Опубликовано</h5>
              <!-- Text -->
              <p class="card-text font-weight-bold">{{ $articles->where('published', 'Опубликована')->count() }}</p>

            </div>

          </div>
          <!-- Card -->
        </div>
        <div class="col-md-4 p-2 d-flex align-items-stretch">
          <!-- Card -->
          <div class="card w-100">

            <!-- Card content -->
            <div class="card-body">

              <!-- Title -->
              <h5 class="card-title border-bottom">Не опубликовано</h5>
              <!-- Text -->
              <p class="card-text font-weight-bold">{{ $articles->where('published', 'Не опубликована')->count() }}</p>
              <!-- Button -->
              <a href="{{ route('admin.articles.no-publish') }}" class="btn btn-primary">Перейти</a>

            </div>

          </div>
          <!-- Card -->
        </div>
      </div>
    </div>

    <div class="col-md-6">

    </div>
  </div>
</div>

@endsection
