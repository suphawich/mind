<div class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
    <div class="container">
        <a href="/" class="navbar-brand">MIND</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/items">My items</a>
                </li>
                {{-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="download" aria-expanded="false">Journal <span class="caret"></span></a>
                    <div class="dropdown-menu" aria-labelledby="download">
                        <a class="dropdown-item" href="https://jsfiddle.net/bootswatch/uyeaokyd/">Open in JSFiddle</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../4/journal/bootstrap.min.css">bootstrap.min.css</a>
                        <a class="dropdown-item" href="../4/journal/bootstrap.css">bootstrap.css</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../4/journal/_variables.scss">_variables.scss</a>
                        <a class="dropdown-item" href="../4/journal/_bootswatch.scss">_bootswatch.scss</a>
                    </div>
                </li> --}}
            </ul>

            <ul class="nav navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}" ><i class="fa fa-sign-in"></i> Log in</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}" ><i class="fa fa-registered"></i> Register</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fa fa-user"></i> {{ Auth::user()->full_name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/items">
                                <i class="fa fa-check-square-o"></i> {{ __('My Items') }}
                            </a>
                            <a class="dropdown-item" href="/setting">
                                <i class="fa fa-cog"></i> {{ __('Setting') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out"></i> {{ __('Logout') }}
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
</div>
