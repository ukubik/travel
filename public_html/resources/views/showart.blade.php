@extends('layouts.main')
@push('styles')
<style media="screen">
  .jumbotron {
    background-image: url({{ '/public/storage/' . $article->img_prew_path }});
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
    <h1 class="display-4">{{ $article->title }}</h1>
    <p class="lead">{{ $article->description }}</p>
  </div>
</div>

<div class="container-fluid">

  <div class="row white-text ">

    <div class="col-md-9">
      <div class="row mb-5">
        <div class="col p-5">
          {!! $article->content !!}
        </div>
      </div>
      <comment-create :article_id="{{ $article->id }}"></comment-create>
    </div>

    <div class="col-md-3 pt-4 bg-dark z-depth-3">
      <div class="row my-5">
        <div class="col text-center">
          <h3>Раздел Интересное</h3>
        </div>
      </div>
      <now-reading></now-reading>
    </div>

  </div>

</div>

@endsection
