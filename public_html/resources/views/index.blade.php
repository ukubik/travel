@extends('layouts.main')

@section('content')
@if($categories && $categories->isNotEmpty())
<newheader-component v-bind:categories="{{ json_encode($categories) }}"></newheader-component>
@foreach($categories as $category)
<div class="container">
  <div class="row my-5">
    <div class="col-auto">
      <h1>{{ $category->header }}</h1>  
    </div>
  </div>
</div>
@endforeach
@endif
@endsection
