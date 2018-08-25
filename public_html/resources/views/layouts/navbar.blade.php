<!--Main Navigation-->
<header>

    <nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar">
        <a class="navbar-brand" href="{{ route('index') }}">
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
                <li class="nav-item">
                    <a class="nav-link" href="{{ '/' . $category->link_name }}"> {{ $category->menu_name }} <span class="sr-only">(current)</span></a>
                </li>
              @endif
              @endforeach
            </ul>
            @endif

            <ul class="navbar-nav nav-flex-icons mr-5">
              @guest
                <li class="nav-item" data-toggle="tooltip" data-placement="bottom" title="Войти или зарегистрироваться">
                    <a class="nav-link"><i class="fa fa-users" aria-hidden="true" data-toggle="modal" data-target="#auth"></i></a>
                </li>
              @else
              <li class="nav-item" data-toggle="tooltip" data-placement="bottom" title="Мой профиль">
                  <a class="nav-link"><i class="fa fa-user" aria-hidden="true"></i></a>
              </li>
              <li class="nav-item" data-toggle="tooltip" data-placement="bottom" title="Выйти">
                  <a class="nav-link"><i class="fa fa-caret-square-o-right" aria-hidden="true"></i></a>
              </li>
              @endguest
            </ul>

            <ul class="navbar-nav nav-flex-icons d-flex justify-content-center">
                <li class="nav-item">
                    <a class="nav-link"><i class="fa fa-odnoklassniki"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"><i class="fa fa-vk"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"><i class="fa fa-facebook"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"><i class="fa fa-twitter"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"><i class="fa fa-instagram"></i></a>
                </li>
            </ul>

        </div>
    </nav>

</header>
<!--Main Navigation-->
@guest
<!-- Side Modal Top Right -->
<auth-modal></auth-modal>

<!-- Side Modal Top Right -->
@else

@endguest

@push('scripts')
<script type="text/javascript">

  if(window.screen.width < 990) $('nav').addClass('pink');

  window.onscroll = function() {
    if(window.screen.width >= 990) {
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
