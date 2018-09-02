@extends('layouts.main')

@section('content')
<div class="container">
  <div class="row my-2">
    <div class="col">
      <div class="alert alert-dark">
        <b> <ins>Правила написания статьи:</ins> </b>
      </div>
    </div>
  </div>
<hr>
<form class="" action="{{ route('userarticle.store') }}" method="post">
  {{ csrf_field() }}
  <div class="row">
    <div class="col">
      @if(isset($groups) && $groups->isNotEmpty())
      <label for="article_group">Выберите раздел <span class="red-text">*</span> </label>
      <select class="form-control form-control-sm" id="article_group" name="article_group_id">
        @foreach($groups as $group)
        <option value="{{ $group->id }}">{{ $group->name }}</option>
        @endforeach
      </select>
      @endif
    </div>
    <div class="col">
      <label for="header">Заголовок статьи <span class="red-text">*</span> </label>
      <input type="text" class="form-control form-control-sm" name="header" id="header" value="{{ old('header') }}" required>
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col">
      <label for="Textarea2">Краткое содержание <span class="red-text">*</span> </label>
      <textarea class="form-control" name="description" id="Textarea2" rows="2" required>{{ old('description') }}</textarea>
    </div>
  </div>
  <hr>
  <div class="row my-3">
    <div class="col">
      <textarea name="content" id="editor1" rows="100">{{ old('content') }}</textarea>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col">
      <a href="{{ URL::previous() }}" class="btn btn-sm btn-outline-warning rounded">
        <i class="fa fa-caret-square-o-left mr-2 warning-text" aria-hidden="true"></i>отмена</a>
    </div>
    <div class="col d-flex justify-content-end">
      <button type="submit" class="btn btn-sm btn-outline-indigo rounded">Сохранить</button>
    </div>
  </div>
</form>

</div>

@endsection

@push('script')
<script type="text/javascript" src="{{ asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<!-- <script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script> -->
<script>
  var options = {
    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=',
    // extraPlugins: 'bootstrapVisibility',
    // extraPlugins: 'justify',
  };

  var editor = CKEDITOR.replace('editor1', options);

</script>
@endpush
