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
                <form class="form-horizontal" method="POST" action="{{ route('sendmessage') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Имя <span class="red-text star">*</span></label>

                        <div class="col">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">Ваш E-Mail адрес <span class="red-text star">*</span></label>

                        <div class="col">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                        <label for="message" class="col-md-4 control-label">Ваше сообщение <span class="red-text star">*</span></label>

                        <div class="col">
                            <textarea id="message" name="message" class="form-control" rows="8" cols="80" required>{{ old('message') }}</textarea>
                            @if ($errors->has('message'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('message') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col text-center">
                            <button type="submit" class="btn btn-outline-elegant">
                                Отправить<i class="fa fa-paper-plane-o ml-2"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
</div>

@endsection
