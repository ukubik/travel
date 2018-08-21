@extends('layouts.main')

@section('content')

@if($categories && $categories->isNotEmpty())

<newheader-component v-bind:categories="{{ json_encode($categories) }}"></newheader-component>

<div class="container-fluid">
  <div class="row">

    <div class="col-md-9">
      <div class="row bg-white" style="min-height:500px">
        <div class="col z-depth-3">
          <intro-component></intro-component>
        </div>
      </div>

      <div class="row" style="min-height:600px">
        <div class="col d-flex justify-content-center">
          <second-component></second-component>
        </div>
      </div>

      <div class="row" style="min-height:700px; background-color:#cfd8dc;">
        <div class="col z-depth-3">
          <preview-component></preview-component>
        </div>
      </div>
    </div>

    <div class="col-md-3 pt-4 bg-dark white-text z-depth-3">
      <div class="row my-5">
        <div class="col text-center">
          <h3>Раздел Интересное</h3>
        </div>
      </div>
      <now-reading></now-reading>
    </div>

  </div>

  <div class="row" style="min-height:700px">
    <div class="col">
      <lower-block></lower-block>
    </div>
  </div>

</div>

@endif

@endsection
