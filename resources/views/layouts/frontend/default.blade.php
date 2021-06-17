<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.frontend.components.header')
    @yield('css')
</head>

<body>
    @include('layouts.frontend.components.navigation')
    <div class="container">
        @yield('content')
        @yield('car')
        @yield('testimonial')
    </div>
</body>
@include('layouts.frontend.components.footer')

</html>