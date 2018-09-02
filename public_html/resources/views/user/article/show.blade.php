@extends('layouts.main')

@section('content')

<div class="container">
  <div class="row my-2 text-center">
    <div class="col">
      <h1 class="display-5">{{ $userarticle->header or '' }}</h1>
    </div>
  </div>
  <div class="row my-2">
    <div class="col">
      {!! $userarticle->content or '' !!}
    </div>
  </div>
</div>

@endsection
