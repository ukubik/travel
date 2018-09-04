@extends('layouts.main')

@section('content')

<div class="container">
  <div class="row my-2 text-center pt-5">
    <div class="col pt-5">
      <h1 class="display-5">{{ $userarticle->title or '' }}</h1>
    </div>
  </div>
  <div class="row my-2">
    <div class="col">
      {!! $userarticle->content or '' !!}
    </div>
  </div>
  <div class="row d-flex justify-content-between py-5">
    <a href="{{ route('userarticle.index') }}" class="btn btn-outline-indigo rounded waves-effect">
      <i class="fa fa-caret-square-o-left mr-2 red-text" aria-hidden="true"></i>к списку статей</a>
    <a href="{{ route('userarticle.edit', $userarticle) }}" class="btn btn-outline-indigo rounded waves-effect">править статью
      <i class="fa fa-caret-square-o-right ml-2 red-text" aria-hidden="true"></i></a>
  </div>
</div>

@endsection
