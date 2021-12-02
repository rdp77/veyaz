@include('layouts.components.header')

<body>
    <div id="app">
        <div class="main-wrapper">
            @include('layouts.backend.components.nav')
            @include('layouts.backend.components.sidebar')
            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        @yield('backToContent')
                        <h1>@yield('titleContent')</h1>
                        <div class="section-header-breadcrumb">
                            <div class="breadcrumb-item active">@yield('breadcrumb')</div>
                            @yield('morebreadcrumb')
                        </div>
                    </div>
                    @yield('content')
                </section>
                @yield('modal')
            </div>
            <footer class="main-footer">
                <div class="footer-left">
                    @include('layouts.components.credit')
                </div>
                <div class="footer-right">
                    {{ __('v0.1') }} <div class="bullet"></div>
                    {{ __('Laravel v') . Illuminate\Foundation\Application::VERSION }}
                    <div class="bullet"></div>
                    {{ __('PHP v') . PHP_VERSION }}
                </div>
            </footer>
        </div>
    </div>
    @include('layouts.components.footer')
    <script src="{{ asset('assets/pages/index.js') }}"></script>
    @yield('script')
    @include('vendor.lara-izitoast.toast')
</body>

</html>