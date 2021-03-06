<!--Main Navigation-->
<header>
    <nav class="navbar fixed-top navbar-expand-xl navbar-dark scrolling-navbar bg-grey">
        <a class="navbar-brand" href="{{ route('index') }}" data-toggle="tooltip" data-placement="bottom" title="На главную...">
          <img src="{{ asset('storage/images/site_0/globus.gif') }}" alt="Globus" class="img-fluid" style="max-height:40px;">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          @if($categories && $categories->isNotEmpty())
            <ul class="navbar-nav mr-auto">
              @foreach($categories as $category)
              @if($category->added_menu === 'В меню')
                @if(isset($category->subcategories) && $category->subcategories->isNotEmpty())
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="{{ route('category', $category) }}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                      {{ $category->menu_name }}</a>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="{{ route('category', $category) }}"
                      data-toggle="tooltip" data-placement="bottom" title="{{ $category->description }}"> Перейти к разделу {{ $category->menu_name }}<span class="sr-only">(current)</span></a>
                        @foreach($category->subcategories as $subcategory)
                        <a class="dropdown-item" href="{{ route('category', [$category, $subcategory]) }}"
                        data-toggle="tooltip" data-placement="bottom" title="{{ $subcategory->description }}"><i class="fa fa-genderless mx-2" aria-hidden="true"></i> {{ $subcategory->title }} <span class="sr-only">(current)</span></a>
                        @endforeach
                    </div>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('category', $category) }}"
                    data-toggle="tooltip" data-placement="bottom" title="{{ $category->description }}"> {{ $category->menu_name }} <span class="sr-only">(current)</span></a>
                </li>
                @endif
              @endif
              @endforeach
            </ul>
            @endif

            <ul class="navbar-nav nav-flex-icons mr-2">
              @guest
              <span data-toggle="tooltip" data-placement="bottom" title="Войти или зарегистрироваться">
                <li class="nav-item" aria-hidden="true" data-toggle="modal" data-target="#auth">
                    <a class="nav-link"><i class="fa fa-sign-in"></i></a>
                </li>
              </span>
              @else
              <span data-toggle="tooltip" data-placement="bottom" title="Мой профиль">
                <li class="nav-item" aria-hidden="true" data-toggle="modal" data-target="#userModal">
                    <a class="nav-link"><i class="fa fa-user"></i></a>
                </li>
              </span>
              <li class="nav-item" data-toggle="tooltip" data-placement="bottom" title="Выйти">
                  <a class="nav-link" href="{{ route('logout') }}"
                     onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                     @csrf
                 </form>
              </li>
              @endguest
            </ul>

            <script type="text/javascript">(function() {
              if (window.pluso)if (typeof window.pluso.start == "function") return;
              if (window.ifpluso==undefined) { window.ifpluso = 1;
                var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
                s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
                s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
                var h=d[g]('body')[0];
                h.appendChild(s);
              }})();
            </script>
            <div class="pluso" data-background="transparent" data-options="big,round,line,horizontal,nocounter,theme=07" data-services="vkontakte,odnoklassniki,facebook,twitter,google"></div>
        </div>
    </nav>
</header>


@push('scripts')
<script type="text/javascript">

  if(window.screen.width < 1366) $('nav').addClass('pink');

  window.onscroll = function() {
    if(window.screen.width >= 1366) {
      var scrolled = window.pageYOffset || document.documentElement.scrollTop;
      if(scrolled > 20) {
        $('nav').addClass('pink');
      }

      if(scrolled <= 20) {
        $('nav').removeClass('pink');
      }
    }
  }

  $(function () {
    $('[data-toggle="tooltip"]').tooltip();
  });
</script>
@endpush
