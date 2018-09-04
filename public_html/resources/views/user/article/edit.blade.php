@extends('layouts.main')

@section('content')
<div class="container py-5">
  @if($userarticle)
  <div class="row mb-5 pt-5">
    <div class="col text-center">
      <h3>{{ $userarticle->title }}</h3>
    </div>
  </div>
  <form action="{{ route('userarticle.update', $userarticle) }}" method="post">
    {{ csrf_field() }}
    {{ method_field('PUT') }}


    <div class="row mb-3">
      <div class="col-md-12">
       <textarea id="editor" name="content">{{ $userarticle->content }}</textarea>
     </div>
   </div>

   <div class="row pb-4">
     <div class="col d-flex justify-content-end">
       <button type="submit" class="btn btn-success waves-effect border rounded">сохранить</button>
     </div>
   </div>
  </form>
  @else
  <div class="alert alert-danger">
    <p>Статья не найдена...</p>
  </div>
  @endif
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
