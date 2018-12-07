@extends('layouts.main')


@section('content')

<div class="container mt-5 pt-5">
  <div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card mt-2 mb-4">

            <div class="card-body">
              <h4 class="card-title">Контакты редакции</h4>
              <p>Электронное периодическое издание <a href="/" data-toggle="tooltip" data-placement="bottom" title="Перейти на главную">Путешествия по России</a></p>
              <p>По всем вопросам сотрудничества, работы, отзывам и предложениям можете связаться с нами через контактную форму.
                Ваше обращение будет обработано в течении 48 часов.</p>

                <contacts-component captcha_key="{{ $captcha_key }}" captcha_secret="{{ $captcha_secret }}"></contacts-component>

            </div>
        </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script src="https://www.google.com/recaptcha/api.js?onload=vueRecaptchaApiLoaded&render=explicit" async defer>
</script>
<!-- <script src='https://www.google.com/recaptcha/api.js'></script> -->
@endpush
