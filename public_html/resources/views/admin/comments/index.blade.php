@extends('admin.layouts.main')

@section('content')

<div class="container-fluid">

	<div class="row my-4">
		<div class="col text-center">
			<h3>Комментарии читателей</h3>
		</div>
	</div>

	<comments-component></comments-component>

</div>

@endsection