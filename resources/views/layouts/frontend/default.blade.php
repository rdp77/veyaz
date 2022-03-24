@include('layouts.components.header')

<body class="nk-body bg-white npc-landing ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            @include('layouts.frontend.components.header')
            @include('layouts.frontend.components.feature')
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