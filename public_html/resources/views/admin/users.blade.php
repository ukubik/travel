@extends('admin.layouts.main')

@section('content')

<div class="container">
  <div class="row py-3">
    <div class="col text-center">
      <h3>Список пользователей</h3>
    </div>
  </div>
  <users-component></users-component>
</div>


@endsection
