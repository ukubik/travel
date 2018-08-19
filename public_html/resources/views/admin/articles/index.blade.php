@extends('admin.layouts.main')

@section('content')

<div class="container-fluid">
  <div class="row my-3">
    <div class="col text-center">
      <h3>Список статей категории {{ $category->header }}</h3>
    </div>
  </div>
  @if(isset($articles) && $articles->isNotEmpty())
  <div class="row text-center font-weight-bold grey-text">
    <div class="col">
      Фотография для превью
    </div>
    <div class="col">
      Meta title
    </div>
    <div class="col">
      Meta keywords
    </div>
    <div class="col">
      Meta description
    </div>
    <div class="col">
      Action
    </div>
  </div>
  @foreach($articles as $article)
  <div class="row border-top">
    <div class="col font-weight-bold">
      {{ $article->title }}
    </div>
  </div>
  <article-component :article="{{ json_encode($article) }}"></article-component>
  @endforeach
  <div class="row">
    <div class="col">
      {!! $articles->render() !!}
    </div>
  </div>
  @endif
</div>

@endsection
