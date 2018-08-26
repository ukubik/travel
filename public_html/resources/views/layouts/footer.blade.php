<!-- Footer -->
<footer class="page-footer font-small stylish-color-dark pt-4">

    <!-- Footer Links -->
    <div class="container text-center text-md-left">

      <!-- Grid row -->
      <div class="row">

        <!-- Grid column -->
        <div class="col-md-6 mx-auto">

          <!-- Content -->
          <h5 class="text-uppercase mt-3 mb-4">Путешествия по России</h5>
          <p>Все права защищены. Копирование материалов разрешено c письменного согласия администрации сайта и при наличии активной ссылки на источник.</p>
          <a href="{{ route('privacypolicy') }}" class="mx-2"><ins>Политика конфидециальности</ins></a>
          <a href="{{ route('rules') }}" class="mx-2" title="Пользовательское соглашение"><ins>Пользовательское соглашение</ins></a>

        </div>
        <!-- Grid column -->

        <hr class="clearfix w-100 d-md-none">

        <!-- Grid column -->
        <div class="col-md-2 mx-auto">

          <!-- Links -->
          <!-- <h5 class="font-weight-bold text-uppercase mt-3 mb-4">Links</h5>

          <ul class="list-unstyled">
            <li>
              <a href="#!">Link 1</a>
            </li>
            <li>
              <a href="#!">Link 2</a>
            </li>
            <li>
              <a href="#!">Link 3</a>
            </li>
            <li>
              <a href="#!">Link 4</a>
            </li>
          </ul> -->

        </div>
        <!-- Grid column -->

        <hr class="clearfix w-100 d-md-none">

        <!-- Grid column -->
        <div class="col-md-2 mx-auto">

          <!-- Links -->
          <h5 class="text-uppercase mt-3 mb-4">Перейти</h5>
          @if(isset($categories) && $categories->isNotEmpty())
          <ul class="list-unstyled">
            @foreach($categories as $category)
            <li>
              <a href="{{ route('category', $category) }}">{{ $category->menu_name }}</a>
            </li>
            @endforeach
          </ul>
          @endif

        </div>
        <!-- Grid column -->

      </div>
      <!-- Grid row -->

    </div>
    <!-- Footer Links -->

    <hr>

    <!-- Call to action -->
    <ul class="list-unstyled list-inline text-center py-2">
      <li class="list-inline-item">
        <h5 class="mb-1">Рагистрация бесплатна</h5>
      </li>
      <li class="list-inline-item">
        <a href="#!" class="btn btn-pink btn-rounded" data-toggle="modal" data-target="#registerModal">Зарегистрироваться!</a>
      </li>
    </ul>
    <!-- Call to action -->

    <hr>

    <!-- Social buttons -->
    <ul class="list-unstyled list-inline text-center">
      <li class="list-inline-item">
        <a class="btn-floating btn-fb mx-1">
          <i class="fa fa-facebook"> </i>
        </a>
      </li>
      <li class="list-inline-item">
        <a class="btn-floating btn-tw mx-1">
          <i class="fa fa-twitter"> </i>
        </a>
      </li>
      <li class="list-inline-item">
        <a class="btn-floating btn-gplus mx-1">
          <i class="fa fa-google-plus"> </i>
        </a>
      </li>
      <li class="list-inline-item">
        <a class="btn-floating btn-li mx-1">
          <i class="fa fa-linkedin"> </i>
        </a>
      </li>
      <li class="list-inline-item">
        <a class="btn-floating btn-dribbble mx-1">
          <i class="fa fa-dribbble"> </i>
        </a>
      </li>
    </ul>
    <!-- Social buttons -->

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© {{ date('Y') }} Copyright:
      <a href="{{ route('index') }}"> {{ config('app.name', 'Laravel') }}</a>
    </div>
    <!-- Copyright -->

</footer>
<!-- Footer -->
