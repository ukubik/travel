<!--Main Navigation-->
<header>

    <nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar">
        <a class="navbar-brand" href="#">
          <img src="{{ asset('storage/images/site_0/globus.gif') }}" alt="Globus" class="img-fluid" style="max-height:40px;">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" >Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Opinions</a>
                </li>
            </ul>
            <ul class="navbar-nav nav-flex-icons d-flex justify-content-center">
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

  // if(window.screen.width < 990) {
  //   $('.window-lg').hide();
  // }
</script>
@endpush
