@extends('admin.layouts.main')

@section('content')

<div class="container-fluid">

	<div class="row my-4">
		<div class="col text-center">
			<h3>Комментарии читателей</h3>
		</div>
	</div>

	@if(isset($comments) && $comments->isNotEmpty())
	@foreach($comments as $comment)
	<form id="update-{{ $comment->id }}" action="{{ route('comment.update', $comment) }}" method="post">
		{{ csrf_field() }}
		{{ method_field('PUT') }}
	</form>
	<form id="delete-{{ $comment->id }}" action="{{ route('comment.destroy', $comment) }}" method="post">
		{{ csrf_field() }}
		{{ method_field('DELETE') }}
	</form>
	@endforeach
	<div class="row px-2">
		<div class="col">
			<table class="table table-sm table-bordered z-depth-2">
				<col width="15%">
				<col width="15%">
				<col width="35%">
				<col width="10%">
				<col width="25%">
				<thead class="black white-text">
					<tr class="text-center">
						<th scope="col">Статья</th>
						<th scope="col">Login / Email</th>
						<th scope="col">Содержание</th>
						<th scope="col">Время создания</th>
						<th scope="col">Действие</th>
					</tr>
				</thead>
				<tbody>
					@foreach($comments as $comment)
					<tr>
						<td>{{ $comment->article->title }}</td>
						<td>{{ $comment->name }} / {{ $comment->email }}</td>
						<td>
							<textarea form="update-{{ $comment->id }}" rows="2" class="form-control form-control-sm" name="content">{{ $comment->content }}</textarea>
						</td>
						<td>{{ $comment->created_at }}</td>
						<td>
							@if($comment->published === 'Не опубликован')
							<button type="submit" form="update-{{ $comment->id }}" class="btn btn-sm btn-success waves-effect">Опубликовать</button>
							<input form="update-{{ $comment->id }}" type="hidden" name="published" value="Опубликован">
							@elseif($comment->published === 'Опубликован')
							<button type="submit" form="update-{{ $comment->id }}" class="btn btn-sm btn-purple waves-effect">снять с публикации</button>
							<input form="update-{{ $comment->id }}" type="hidden" name="published" value="Не опубликован">
							@endif
							<button type="submit" form="update-{{ $comment->id }}" class="btn btn-sm btn-warning waves-effect">изменить</button>
							<button type="submit" form="delete-{{ $comment->id }}" class="btn btn-sm btn-danger waves-effect">удалить</button>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			<div class="row">
				<div class="col">
					{!! $comments->render() !!}
				</div>
			</div>
		</div>
	</div>
	@else
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="alert alert-dark">
					Комментариев пока нету...
				</div>
			</div>
		</div>
	</div>
	@endif
</div>

@endsection
