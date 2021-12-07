@include('layouts.components.header')

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    @if (Request::route()->getName() == 'login')
                    <div
                        class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        @else
                        <div
                            class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                            @endif
                            <div class="login-brand">
                                <img src="{{ asset('assets/img/logo.png') }}" alt="logo" width="150">
                            </div>
                            <div class="card card-primary">
                                <div class="card-body">
                                    @yield('content')
                                </div>
                            </div>
                            <div class="mt-5 text-muted text-center">
                                @if (Request::route()->getName() == 'login')
                                {{ __('auth.noAccount') }}
                                <a href="{{ route('register') }}">
                                    {{ __('auth.createAccount') }}
                                </a>
                                @else
                                {{ __('auth.haveAccount') }}
                                <a href="{{ route('login') }}">
                                    {{ __('auth.loginAccount') }}
                                </a>
                                @endif
                            </div>
                            <div class="simple-footer">
                                @include('layouts.components.credit')
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
    @include('layouts.components.footer')
    @yield('script')
</body>

</html>