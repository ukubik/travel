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

<div class="container-fluid">

  <div class="row">

    <div class="col-md-9">

      <div class="container">
        <div class="row mb-5">
          <div class="col pt-4">
            {!! $article->content !!}
          </div>
        </div>

        <div class="row mb-5">
          <div class="col-auto border-bottom">
            Автор: <em class="font-weight-bold">{{ $article->user->login }}</em>
          </div>
        </div>
      </div>

      @if($article->comments->isNotEmpty())

      <div class="container border-bottom my-5">

        <div class="row">
          <div class="col">
            <h5 class="text-uppercase">комментарии наших читателей</h5>
          </div>
        </div>
        @php $comments = $article->comments->sortByDesc('id'); @endphp
        @foreach($comments as $comment)

        @if($comment->published === 'Опубликован')

        <div class="row d-flex justify-content-between">
            <div class="col">
              <small><b>{{ $comment->name }}</b></small>
            </div>
            <div class="col d-flex justify-content-end">
                {{ $comment->created_at }}
            </div>
        </div>

        <div class="row border rounded mb-4">
            <div class="col" style="font-size:90%">
                <em>{{ $comment->content }}</em>
            </div>
        </div>

        @endif

        @endForeach

      </div>

      @endif

      <comment-create :article_id="{{ $article->id }}"></comment-create>
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
