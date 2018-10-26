@extends('layouts.main')

@section('content')

@push('styles')

<style media="screen">
  .fix-bottom {
    position: absolute;
    bottom: 10px;
  }

  .mb-6 {
    margin-bottom: 5rem !important;
  }
</style>

@endpush

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
        <div class="col">

          <div class="row my-3 white-text px-4">
            <div class="col text-uppercase border-bottom border-danger text-shadow">
              <h2 class="h2-responsive">Наши рубрики</h2>
              <h5 class="h5-responsive">основные разделы сайта</h5>
            </div>
          </div>

          <div class="row my-5 px-4">
            @if(isset($categories) && $categories->isNotEmpty())
            @foreach($categories as $category)
            <div class="col-md-4 my-1 px-1 d-flex justify-content-strach">
              <!-- Card -->
              <div class="card">

                <!-- Card image -->
                <div class="view overlay zoom">
                  <img class="card-img-top" src="{{ asset('/public/storage/' . $category->img_path) }}" alt="{{ $category->header }}">
                  <a href="{{ route('category', $category) }}">
                    <!-- <div class="mask rgba-white-slight"></div> -->
                    <div class="mask flex-center waves-effect waves-light">
                      <p class="white-text text-shadow">{{ $category->header }}</p>
                    </div>
                  </a>
                </div>

                <!-- Card content -->
                <div class="card-body elegant-color white-text rounded-bottom">

                  <!-- Title -->
                  <h4 class="card-title">{{ $category->menu_name }}</h4>
                  <!-- Text -->
                  <p class="card-text mb-6">{{ $category->description }}</p>
                  <!-- Button -->
                  <a href="{{ route('category', $category) }}" class="btn btn-outline-white waves-effect fix-bottom" title="{{ $category->header }}">
                    подробнее...
                    <i class="fa fa-angle-double-right fa-15x ml-2" aria-hidden="true"></i>
                  </a>

                </div>

              </div>
              <!-- Card -->
            </div>
            @endforeach
            @endif
          </div>

        </div>
      </div>

      <div class="row art-preview" id="art-preview">
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

    <div class="col-md-3 py-2 bg-dark white-text z-depth-3">
      <div class="row my-5">
        <div class="col text-center">
          <h4>Вам будет интересно</h4>
        </div>
      </div>
      <now-reading></now-reading>
      <last-comments></last-comments>
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

@push('scripts')
<!-- <script type="text/javascript">
$(function () {
  $(".sticky").sticky({
      topSpacing: 90,
      zIndex: 2,
      // stopper: "#YourStopperId"
  });
});
</script> -->
@endpush
