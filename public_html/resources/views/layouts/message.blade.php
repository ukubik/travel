<!-- Вывод ошибок из контроллера -->
@if(isset($errors) && $errors->any() && !$errors->isEmpty())
    <div class="alert alert-danger z-depth-2 mt-2" role="alert" id="alert" style="display:">
      <button type="button" class="close" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <ul>
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>

@endif

<!-- Вывод сообщения если все хорошо -->
@if(Session::has('message'))

    <div class="alert alert-success z-depth-2 mt-2" role="alert" id="alert">
      <button type="button" class="close" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <div id="message">{{ Session::get('message') }}</div>
    </div>

@endif

@push('scripts')
<script type="text/javascript">
  $(document).ready(function() {
    $('.close').bind('click', function() {
      $('#alert').hide();
    });
  })
</script>
@endpush
