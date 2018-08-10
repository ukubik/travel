@extends('layouts.main')

@section('content')

<header-component v-bind:images="{{ json_encode($images) }}"></header-component>

<north-component></north-component>

@endsection
