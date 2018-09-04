<nav class="navbar navbar-expand-md navbar-light bg-grey z-depth-3">
    <div class="container-fluid">
        <a class="navbar-brand white-text" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.index') }}">{{ __('HomeAdmin') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('users.index') }}">{{ __('Users') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('categories.index') }}">{{ __('Categories') }}</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                          {{ __('Articles') }}</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('admin.article.create') }}">Новая статья</a>
                            @if(isset($categories) && $categories->isNotEmpty())
                            @foreach($categories as $category)
                            <a class="dropdown-item" href="{{ route('admin.article.index', $category->id) }}">{{ $category->menu_name }}</a>
                            @endforeach
                            @endif
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('comment.index') }}">{{ __('Comments') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('guestmessage.index') }}">{{ __('Messages') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('claims.index') }}">{{ __('Claims') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.images.index') }}">{{ __('Images') }}</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->login }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
