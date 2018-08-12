@extends('layouts.main')

@section('content')

<newheader-component v-bind:categories="{{ json_encode($categories) }}"></newheader-component>

<north-component v-bind:images="{{ json_encode($north_imgs) }}"></north-component>

@endsection
