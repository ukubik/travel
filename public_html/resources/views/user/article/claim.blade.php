@extends('layouts.main')

@section('content')

<div class="container">
  <div class="row mt-5 pt-5">
    <div class="col-md-8 offset-md-2">
        <div class="card mt-2 mb-4">
          
            <div class="card-body">
              <h4 class="card-title">Правила подачи заявки</h4>
              <p>Подавая заявку, Вы подтверждаете, что размещаемые статьи не являются плагиатом. Заполните форму ниже.
                Кратко опишите содержание Ваших статей. В случае удовлетворения заявки, Вы получаете статус "Автор". Заявка может быть
               отклонена без объяснения причин. При нарушении <a href="{{ route('rules') }}" class="blue-text" target="_blank">
                 <ins>Пользовательского соглашения</ins> </a>Ваш аккаунт будет заблокирован, а статьи удалены.</p>
                <form class="form-horizontal" method="POST" action="{{ route('user.new.autor', $user) }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                    <div class="form-group{{ $errors->has('theme') ? ' has-error' : '' }}">
                        <label for="theme" class="col control-label">Основная тема <span class="red-text stars">*</span>
                          <span class="text-muted">(Место путешествия, отдых на море и т.п...)</span>
                          </label>

                        <div class="col">
                            <input id="theme" type="text" class="form-control" name="theme" value="{{ old('theme') }}" required>

                            @if ($errors->has('theme'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('theme') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                        <label for="description" class="col-md-4 control-label">Краткое содержание <span class="red-text stars">*</span></label>

                        <div class="col">
                            <textarea id="description" name="description" class="form-control" rows="8" cols="80" required>{{ old('description') }}</textarea>
                            @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                      <div class="col-md-6">
                          <a href="{{ URL::previous() }}" class="btn btn-success border rounded">
                              <i class="fa fa-caret-square-o-left mr-2 warning-text" aria-hidden="true"></i>отмена
                          </a>
                      </div>
                        <div class="col-md-6 d-flex justify-content-end">
                            <button type="submit" class="btn btn-pink border rounded">
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
