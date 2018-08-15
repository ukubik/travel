@extends('layouts.main')

@section('content')

@if($categories && $categories->isNotEmpty())

<newheader-component v-bind:categories="{{ json_encode($categories) }}"></newheader-component>

<div class="container-fluid">
  <div class="row">

    <div class="col-md-9 my-4">
      <h1>Основная область</h1>
    </div>

    <div class="col-md-3 mb-4 pt-4 bg-dark white-text">
      <h3>Раздел Интересное</h3>
    </div>

  </div>
</div>

@endif

@endsection
