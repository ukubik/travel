@extends('admin.layouts.main')

@section('content')

<new-article></new-article>

@endsection

@push('scripts')
<script src="{{ asset('/ckeditor/ckeditor.js') }}" type="text/javascript" charset="utf-8" ></script>
<script>
  var options = {
    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=',
    // extraPlugins: 'bootstrapVisibility',
    // extraPlugins: 'justify',
  };

  var editor = CKEDITOR.replace( 'editor1', options);
</script>
@endpush
