<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li>
                <a href="javascript:void(0)" data-toggle="sidebar" class="nav-link nav-link-lg">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown">
            <a href="javascript:void(0)" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                {{-- <img alt="image" src="{{ asset('assets/img/avatar.png') }}" class="rounded-circle mr-1"> --}}
                <figure class="avatar mr-2 avatar-sm bg-info text-white"
                    data-initial="{{ Str::upper(substr(Auth::user()->name, 0, 2)) }}"></figure>
                <div class="d-sm-none d-lg-inline-block">{{ __('Hai, ') . Auth::user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">{{ __('Administrator') }}</div>
                <a id="name" class="dropdown-item has-icon" style="cursor: pointer">
                    <i class="fas fa-user"></i> {{ __('Ganti Nama') }}
                </a>
                <a href="{{ route('users.password') }}" class="dropdown-item has-icon">
                    <i class="fas fa-key"></i> {{ __('Ganti Password') }}
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();"
                    class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> {{ __('auth.logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>