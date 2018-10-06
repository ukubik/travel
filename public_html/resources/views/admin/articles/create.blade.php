@extends('admin.layouts.main')

@section('content')

<div class="container-fluid">

  <!-- <div class="row my-3">
    <div class="col text-center">
      <h1>{{ $article->title or 'Новая статья' }}</h1>
    </div>
  </div> -->

  <form action="{{ route('admin.article.store') }}" method="post">
    {{ csrf_field() }}
    <div class="row my-2">
      <div class="col-md-4 border-right">
        <label for="cat-id"> <small>Выберите категорию статьи</small> <i class="fa fa-exclamation ml-2 red-text" aria-hidden="true"></i> </label>
        <select class="form-control form-control-sm" name="category_id" value="{{ old('category_id') }}">
          @foreach($categories as $category)
          <option value="{{ $category->id }}">{{ $category->header }}</option>
          @if(isset($category->subcategories) && $category->subcategories->isNotEmpty())
          @foreach($category->subcategories as $subcategory)
          <option value="{{ $category->id }}/{{ $subcategory->id }}" style="font-size:90%">&nbsp;&nbsp;&nbsp;->{{ $subcategory->title }}</option>
          @endforeach
          @endif
          @endforeach
        </select> <hr>
        <label for="article-title"> <small>Введите заголовок статьи</small> <i class="fa fa-exclamation ml-2 red-text" aria-hidden="true"></i> </label>
        <input type="text" class="form-control form-control-sm" name="art_title" value="{{ old('art_title') }}">
      </div>

      <div class="col-md-4 border-right">
        <label for="description"> <small>Краткое содержание статьи <span class="text-muted">( макс. 120 символов )</span> </small> <i class="fa fa-exclamation ml-2 red-text" aria-hidden="true"></i></label>
        <textarea name="description" rows="5" class="form-control form-control-sm">{{ old('description') }}</textarea>
      </div>

      <div class="col-md-4">
        <label for="article-title"> <small>Meta Tags</small><i class="fa fa-exclamation ml-2 red-text" aria-hidden="true"></i></label>
        <input type="text" class="form-control form-control-sm mb-2" name="tag_title" value="{{ old('tag_title') }}" placeholder="Title">

        <input type="text" class="form-control form-control-sm mb-2" name="tag_keywords" value="{{ old('tag_keywords') }}" placeholder="KeyWords">

        <textarea name="tag_description" rows="3" class="form-control form-control-sm" placeholder="Description">{{ old('tag_description') }}</textarea>
      </div>
    </div>

    <div class="row mb-3">
      <div class="col-md-12">
       <textarea id="editor" name="content">{{ old('content') }}</textarea>
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
