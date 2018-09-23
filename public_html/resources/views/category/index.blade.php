@extends('layouts.main')
@push('styles')
<style media="screen">
  .jumbotron {
    background-image: url({{ '/public/storage/' . $category->img_path }});
    background-size: cover;
    padding: 6rem 2rem;
    color: white;
    text-shadow: 1px 1px 2px black, 0 0 1em black;
  }
</style>
@endpush
@section('content')

<div class="jumbotron jumbotron-fluid" style="margin-bottom:0">
  <div class="container">
    <h1 class="h1-responsive">{{ $category->header }}</h1>
    <p class="lead">{{ $category->description }}</p>
  </div>
</div>

<div class="container-fluid" style="min-height: 500px">

  <div class="row">

    <div class="col-md-9 mt-4 p-5">

      @if(isset($subcategories) && $subcategories->isNotEmpty())
      <div class="row mb-5 border-bottom">
        <div class="col-auto mb-2 border-right">
          <a class="btn btn-sm btn-outline-danger waves-effect" href="{{ route('category', $category) }}"
          data-toggle="tooltip" data-placement="bottom" title="{{ $category->description }}"> {{ $category->menu_name }} <span class="sr-only">(current)</span></a>
        </div>
        @foreach($subcategories as $subcategory)
        <div class="col-auto mb-2">
          <a class="btn btn-sm btn-outline-primary waves-effect" href="{{ route('category', [$category, $subcategory]) }}"
          data-toggle="tooltip" data-placement="bottom" title="{{ $subcategory->description }}"> {{ $subcategory->title }} <span class="sr-only">(current)</span></a>
        </div>
        @endforeach
      </div>
      @endif

      @if($articles && $articles->isNotEmpty())
      <div class="row white-text" style="min-height: 272px">
        @foreach($articles as $article)
          <article-preview :article="{{ json_encode($article) }}"></article-preview>
        @endforeach
      </div>
      @else
      <div class="row">
        <div class="col text-center">
          <h1>В разделе пока нет статей...</h1>
        </div>
      </div>
      @endif
    </div>

    <div class="col-md-3 pt-4 bg-dark z-depth-3 white-text">
      <div class="row my-5">
        <div class="col text-center">
          <h3>Вам будет интересно</h3>
        </div>
      </div>
      <now-reading></now-reading>
    </div>

  </div>

</div>

@endsection
