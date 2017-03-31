<!-- Authentication Links -->
@if (Auth::guest())
    <li class="nsh-guest-menu-item"><a href="{{ route('login') }}">Login</a></li>
    <li class="nsh-guest-menu-item"><a href="{{ route('register') }}">Register</a></li>
    <div class="dropdown nsh-guest-dropdown-menu">
      <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
        <i class="material-icons">&#xE5D2;</i>
      </button>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
        <li class="nsh-guest-dropdown-menu-item"><a href="{{ route('login') }}">Login</a></li>
        <li class="nsh-guest-dropdown-menu-item"><a href="{{ route('register') }}">Register</a></li>
      </ul>
    </div>
@else
    <div class="dropdown nsh-user-dropdown-menu">
      <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
        <i class="material-icons">&#xE853;</i>
      </button>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
        <li class="nsh-user-dropdown-menu-item"><a href="{{ route('account') }}">My Account</a></li>
        <li class="nsh-user-dropdown-menu-item"><a href="{{ route('logout') }}"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        Logout </a>
                        <form id="logout-form" action="{{ route('logout') }}"method="POST" style="display: none;">
                {{ csrf_field() }}
                </form></li>
      </ul>
    </div>
@endif
