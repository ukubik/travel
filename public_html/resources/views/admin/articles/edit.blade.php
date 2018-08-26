@extends('admin.layouts.main')

@section('content')

<div class="container-fluid">

  <div class="row my-3">
    <div class="col text-center">
      <h1>{{ $article->title or 'Новая статья' }}</h1>
    </div>
  </div>

  <form action="{{ route('admin.article.update', $article) }}" method="post">
    {{ csrf_field() }}
    {{ method_field('PUT') }}

    <div class="row mb-3">
      <div class="col-5">
        <label for="title">Заголовок</label>
        <input id="title" type="text" class="form-control form-control-sm" name="title" value="{{ $article->title }}">
      </div>
      <div class="col-7">
        <label for="description">Краткое содержание <small class="text-muted">( макс. 120 символов )</small> </label>
        <textarea id="description" name="description" rows="2" class="form-control form-control-sm">{{ $article->description }}</textarea>
      </div>
    </div>

    <div class="row mb-3">
      <div class="col-md-12">
       <textarea id="editor" name="content">{{ $article->content }}</textarea>
     </div>
   </div>

   <div class="row mb-4">
     <div class="col d-flex justify-content-end">
       <button type="submit" class="btn btn-success waves-effect border rounded">сохранить</button>
     </div>
   </div>
  </form>
</div>

@endsection

@push('scripts')
<script src="{{ asset('/ckeditor/ckeditor.js') }}" type="text/javascript" charset="utf-8" ></script>
<script>
  var options = {
    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=',
  };

  var editor = CKEDITOR.replace( 'editor', options);
</script>
@endpush
