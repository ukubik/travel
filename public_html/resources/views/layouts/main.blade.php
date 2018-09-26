<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $article->metatag->title or config('app.name') }}</title>
    <meta name="yandex-verification" content="8e987aee4724a7b7" />
    <meta name="description" content="{{ $article->metatag->description or 'Все о путешествиях по России. Статьи о людях, городах, обычаях самой большой страны. Заметки путешественников, всевозможные идеи для тех, что любит свою страну и планирует поездки по России или только мечтает о них' }}">
    <meta name="keywords" content="{{ $article->metatag->keywords or 'путешествия по России, туризм, интересные статьи, заметки путешественников, полезные советы для туристов' }}">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
    <link href="{{ asset('css/mdb.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/my-styles.css') }}" rel="stylesheet">
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
        (function (d, w, c) {
            (w[c] = w[c] || []).push(function() {
                try {
                    w.yaCounter50497918 = new Ya.Metrika2({
                        id:50497918,
                        clickmap:true,
                        trackLinks:true,
                        accurateTrackBounce:true
                    });
                } catch(e) { }
            });

            var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () { n.parentNode.insertBefore(s, n); };
            s.type = "text/javascript";
            s.async = true;
            s.src = "https://mc.yandex.ru/metrika/tag.js";

            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else { f(); }
        })(document, window, "yandex_metrika_callbacks2");
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/50497918" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
    @stack('styles')
</head>
  <body>

    @include('layouts.navbar')

    <div id="app">

      <div class="container">
        <div class="row">
          <div class="col-md-8 offset-md-2">
            @include('layouts.message')
          </div>
        </div>
      </div>
      @yield('content')

      @guest
      <!-- Side Modal Top Right -->
      <auth-modal></auth-modal>
      <register-modal></register-modal>
      <!-- Side Modal Top Right -->
      @else
      <user-modal></user-modal>
      <already-registered></already-registered>
      <edit-profile></edit-profile>
      @endguest

    </div>

    @include('layouts.footer')
    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/mdb.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
  </body>
</html>
