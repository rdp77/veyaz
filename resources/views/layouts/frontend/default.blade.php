@include('layouts.components.header')

{{--

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div
                        class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="login-brand">
                            <img src="{{ asset('assets/img/logo.png') }}" alt="logo" width="150">
                        </div>
                        <div class="card card-dark">
                            <div class="card-body">
                                @yield('content')
                            </div>
                        </div>
                        <div class="simple-footer">
                            @include('layouts.components.credit')
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body> --}}


<body class="nk-body bg-white npc-landing ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            @include('layouts.frontend.components.header')
            @include('layouts.frontend.components.feature')
            @include('layouts.frontend.components.pricing')
            @include('layouts.frontend.components.story')
            @include('layouts.frontend.components.callToAction')
            @include('layouts.frontend.components.footer')
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    @include('layouts.components.footer')
    @yield('script')
</body>

</html>