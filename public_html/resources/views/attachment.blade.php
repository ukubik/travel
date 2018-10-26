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
    <h1 class="h1-responsive">{{ $article->title }}</h1>
    <p class="lead">{{ $article->description }}</p>
  </div>
</div>

<div class="cintainer-fluid">

  <div class="row">

    <div class="col-md-9">
      @if($article)
      <div class="row my-4">
        <div class="col-md-4 offset-md-4">
          <!-- Card -->
          <div class="card hoverable">

            <!-- Card image -->
            <a href="{{ '/article/' . $article->id  }}">
              <img class="card-img-top hoverable" src="{{ $img_puth }}" alt="Card image cap">
            </a>

            <!-- Card content -->
            <div class="card-body">

              <!-- Title -->
              <h4 class="card-title"><a>{{ $article->title }}</a></h4>
              <!-- Text -->
              <p class="card-text">{{ $article->description }}</p>
              <!-- Button -->
              <a href="{{ '/article/' . $article->id  }}" class="btn btn-pink btn-lg waves-effect">читать</a>

            </div>

          </div>
          <!-- Card -->
        </div>
      </div>
      @endif

    </div>

    <div class="col-md-3 py-2 bg-dark z-depth-3 white-text">
      <div class="row my-5">
        <div class="col text-center">
          <h3>Вам будет интересно</h3>
        </div>
      </div>
      <now-reading :article_id="{{ $article->id }}"></now-reading>
      <last-comments></last-comments>
    </div>

  </div>

</div>


@endsection
