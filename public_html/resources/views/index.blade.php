@extends('layouts.main')

@section('content')

@if($categories && $categories->isNotEmpty())

<newheader-component v-bind:categories="{{ json_encode($categories) }}"></newheader-component>

<div class="container-fluid">
  <div class="row">

    <div class="col-md-9">
      <div class="row bg-white" style="min-height:600px">
        <div class="col z-depth-3">
          <intro-component></intro-component>
        </div>
      </div>

      <div class="row" style="min-height:700px">
        <div class="col d-flex justify-content-center text-shadow">
          <second-component></second-component>
        </div>
      </div>

      <div class="row art-preview">
        <div class="col z-depth-3">
          <div class="container-fluid p-5">
            @if($previews1 && $previews1->isNotEmpty())
            <div class="row my-3">
              <div class="col text-uppercase border-bottom border-danger">
                <h2 class="h2-responsive">Свежие статьи</h2>
                <h5 class="h5-responsive">новости из разных уголков россии</h5>
              </div>
            </div>
            <div class="row white-text" style="min-height: 272px">
              @foreach($previews1 as $preview)
                <article-preview :article="{{ json_encode($preview) }}"></article-preview>
              @endforeach
            </div>
            @endif
            @if($previews2 && $previews2->isNotEmpty())
            <div class="row white-text" style="min-height: 272px">
              @foreach($previews2 as $preview)
                <article-preview :article="{{ json_encode($preview) }}"></article-preview>
              @endforeach
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-3 pt-4 bg-dark white-text z-depth-3">
      <div class="row my-5">
        <div class="col text-center">
          <h4>Вам будет интересно</h4>
        </div>
      </div>
      <now-reading></now-reading>
    </div>

  </div>

  <div class="row" style="min-height:700px">
    <div class="col text-shadow">
      <lower-block></lower-block>
    </div>
  </div>

</div>

@endif

@endsection

@push('styles')
<style media="screen">
  #app {
    background-image: url(/public/storage/images/site_0/fone2.jpg);
    background-attachment: fixed;
    background-repeat: no-repeat;
    background-size: cover;
    /* background-color: #000; */
  }
</style>
@endpush
