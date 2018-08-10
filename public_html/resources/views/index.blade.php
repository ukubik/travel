@extends('layouts.main')

@section('content')

<header-component v-bind:images="{{ json_encode($images) }}"></header-component>

<north-component v-bind:images="{{ json_encode($north_imgs) }}"></north-component>

@endsection
