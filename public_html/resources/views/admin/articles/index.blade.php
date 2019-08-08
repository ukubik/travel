@extends('admin.layouts.main')

@section('content')

<div class="container-fluid">
  <div class="row my-3">
    <div class="col text-center">
      <h3>Список статей категории {{ $category->header or 'Не опубликовано' }}</h3>
      @if($subcategory)
      <h5>Подкатегория {{ $subcategory->title }}</h5>
      @endif
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
    <div class="col-1 pl-0">
        Просмотры/Лаки
    </div>
    <div class="col">
      Action
    </div>
  </div>
  @foreach($articles as $article)
  <div class="row border-top border-dark">
    <div class="col-md-auto p-2 font-weight-bold">
      {{ $article->title }}
    </div>
    <div class="col-md-auto p-2">
      Автор: <em>{{ $article->user->login }}</em>
    </div>
    <div class="col-md-auto p-2">
      <small class="text-muted"> Выберите категорию, нажмите "Изменить" </small>
      <form class="form-inline" action="{{ route('admin.new-category', $article) }}" method="post">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="form-group">
          <select class="form-control form-control-sm" name="category_id" value="{{ $article->category->name }}">
            @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->header }}</option>
            @if(isset($category->subcategories) && $category->subcategories->isNotEmpty())
            @foreach($category->subcategories as $subcategory)
            <option value="{{ $category->id }}/{{ $subcategory->id }}" style="font-size:90%">&nbsp;&nbsp;&nbsp;->{{ $subcategory->title }}</option>
            @endforeach
            @endif
            @endforeach
          </select>
        </div>
        <button type="submit" class="btn btn-sm btn-warning"> Измениить</button>
      </form>
    </div>
  </div>
  <article-component :article="{{ json_encode($article) }}"></article-component>
  @endforeach
  <div class="row">
    <div class="col">
      {!! $articles->render() !!}
    </div>
  </div>
  @else
  <div class="row">
    <div class="col text-center">
      <h3>В данной категории статьи не неайдены...</h3>
    </div>
  </div>
  @endif
</div>

@endsection
