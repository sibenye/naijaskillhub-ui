<!-- Authentication Links -->
@if (Auth::guest())
    <li><a href="{{ route('login') }}">Login</a></li>
    <li><a href="{{ route('register') }}">Register</a></li>
    @else
        <button id="demo-menu-lower-right"
        class="mdl-button mdl-js-button mdl-button--icon">
          <i class="material-icons">account_circle</i>
        </button>

<ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
    for="demo-menu-lower-right">
  <li class="mdl-menu__item"><a href="{{ route('account') }}">My Account</a></li>
  <li class="mdl-menu__item"><a href="{{ route('logout') }}"
                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    Logout </a>

            <form id="logout-form" action="{{ route('logout') }}"method="POST" style="display: none;">
            {{ csrf_field() }}
            </form></li>
</ul>

    @endif