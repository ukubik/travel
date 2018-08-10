@extends('admin.layouts.main')

@section('content')

<categories-component :categories="{{ json_encode($categories) }}"></categories-component>

@endsection
