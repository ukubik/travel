@extends('admin.layouts.main')

@section('content')

<div class="container">
  <div class="row mt-3">
    <div class="col text-center">
      <h1>Admin Images</h1>
    </div>
  </div>
</div>

<img-category :categories="{{ $img_categories }}"></img-category>

@endsection
