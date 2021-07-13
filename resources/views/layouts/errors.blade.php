@include('layouts.components.header')

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="page-error">
                    <div class="page-inner">
                        <h1>@yield('code')</h1>
                        <div class="page-description">
                            @yield('message')
                        </div>
                        <div class="mt-3">
                            <a href="{{ url('/') }}">
                                {{ __('pages.backTo') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="simple-footer mt-5">
                    @include('layouts.components.credit')
                </div>
            </div>
        </section>
    </div>
    @include('layouts.components.footer')
</body>

</html>