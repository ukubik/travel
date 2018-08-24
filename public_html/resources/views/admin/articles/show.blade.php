@extends('admin.layouts.main')

@section('content')

<div class="container">
  <div class="row my-2 text-center">
    <div class="col">
      <h1 class="display-5">{{ $article->title or '' }}</h1>
    </div>
  </div>
  <div class="row my-2">
    <div class="col">
      {!! $article->content or '' !!}
    </div>
  </div>
  <div class="row d-flex justify-content-between">
    <a href="{{ URL::previous() }}" class="btn btn-outline-indigo rounded waves-effect">
      <i class="fa fa-caret-square-o-left mr-2 red-text" aria-hidden="true"></i>назад</a>
    <a href="{{ route('admin.article.edit', $article) }}" class="btn btn-outline-indigo rounded waves-effect">править
      <i class="fa fa-caret-square-o-right ml-2 red-text" aria-hidden="true"></i></a>
  </div>
</div>

@endsection
