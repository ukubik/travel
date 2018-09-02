@extends('layouts.main')
@section('content')
<div class="container">

  <div class="row my-4">
    <div class="col">
      @if(isset($articles) && $articles->isNotEmpty())
      <h4>Список моих статей</h4>
      <!-- <div class="alert alert-info" role="alert">
        Вы можете отредактировать статью только один раз. Для этого нажмите <b>Просмотр</b> и если Вам что-то не нравится, на странице просмотра статьи
        нажмите <b>Редактировать</b>.
      </div> -->

      <table class="table table-sm mt-3">
        <thead class="text-white bg-dark text-center">
          <tr>
            <th class="border">Заголовок</th>
            <th class="border">Краткое содержание</th>
            <th class="border">Статус</th>
            <th class="border">Действие</th>
          </tr>
        </thead>

        <tbody>
          @foreach($articles as $article)
          <tr>
            <td class="border">{{ $article->header }}</td>
            <td class="border">{{ $article->description }}</td>
            <td class="border">{{ $article->published }}</td>
            <td class="border">
              <a href="{{ route('userarticle.show', $article) }}" class="btn btn-sm btn-info rounded mx-1 my-2 waves-effect">просмотр&nbsp;&nbsp;</a><br>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      @else
      <div class="alert alert-dark" role="alert">
        Вы пока не разместили ни одной статьи... <br>
        <a href="{{ route('userarticle.create') }}" class="blue-text"> <ins>Перейти в редактор</ins> </a>
      </div>
      @endif
    </div>
  </div>
  <div class="row">
    <div class="col">
      <a href="{{ route('userarticle.create') }}" class="btn btn-info rounded">новая статья</a>
    </div>
  </div>
</div>

@endsection
