@extends('layouts.main')

@section('content')

@if($categories && $categories->isNotEmpty())

<newheader-component v-bind:categories="{{ json_encode($categories) }}"></newheader-component>

<div class="container-fluid">
  <div class="row">

    <div class="col-md-9">
      <div class="row bg-white" style="min-height:500px">
        <div class="col z-depth-3">
          <h1>Основная область</h1>
        </div>
      </div>

      <div class="row" style="min-height:600px">
        <div class="col d-flex justify-content-center">
          <h1>Что-то еще</h1>
        </div>
      </div>

      <div class="row" style="min-height:700px; background-color:#cfd8dc;">
        <div class="col z-depth-3">

        </div>
      </div>
    </div>

    <div class="col-md-3 pt-4 bg-dark white-text z-depth-3">
      <h3>Раздел Интересное</h3>
    </div>

  </div>

  <div class="row" style="min-height:700px">
    <div class="col">

    </div>
  </div>

</div>

@endif

@endsection
