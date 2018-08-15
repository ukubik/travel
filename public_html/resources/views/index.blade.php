@extends('layouts.main')

@section('content')

@if($categories && $categories->isNotEmpty())

<newheader-component v-bind:categories="{{ json_encode($categories) }}"></newheader-component>

@foreach($categories as $category)

<category-component :category="{{ json_encode($category) }}"></category-component>

@endforeach

@endif

@endsection
