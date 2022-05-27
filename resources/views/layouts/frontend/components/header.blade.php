<header class="header header-32 has-header-main-s1 bg-dark" id="home">
    <div class="header-main header-main-s1 is-sticky is-transparent on-dark">
        <div class="container header-container">
            <div class="header-wrap">
                <div class="header-logo">
                    <a href="html/index.html" class="logo-link">
                        <img class="logo-light logo-img" src="./images/logo.png" srcset="./images/logo2x.png 2x"
                            alt="logo">
                        <img class="logo-dark logo-img" src="./images/logo-dark.png"
                            srcset="./images/logo-dark2x.png 2x" alt="logo-dark">
                    </a>
                </div>
                <div class="header-toggle">
                    <button class="menu-toggler" data-target="mainNav">
                        <em class="menu-on icon ni ni-menu"></em>
                        <em class="menu-off icon ni ni-cross"></em>
                    </button>
                </div><!-- .header-nav-toggle -->
                <nav class="header-menu" data-content="mainNav">
                    <ul class="menu-list ml-lg-auto">
                        <li class="menu-item">
                            <a href="#home" class="menu-link nav-link">Home</a>
                        </li>
                        <li class="menu-item">
                            <a href="#feature" class="menu-link nav-link">Features</a>
                        </li>
                        <li class="menu-item">
                            <a href="#explore" class="menu-link nav-link">Explore</a>
                        </li>
                    </ul>
                    <ul class="menu-btns">
                        <li>
                            <a href="#" target="_blank" class="btn btn-primary btn-lg">{{ __('Documentation') }}</a>
                        </li>
                    </ul>
                </nav><!-- .nk-nav-menu -->
            </div><!-- .header-warp-->
        </div><!-- .container-->
    </div><!-- .header-main-->
    <div class="header-content py-6 is-dark mt-lg-n1 mt-n3">
        <div class="container">
            <div class="row flex-row-reverse justify-content-center text-center g-gs">
                <div class="col-lg-6 col-md-7">
                    <div class="header-caption">
                        <h1 class="header-title">Powelful Tool To Represent Your Dashboard.</h1>
                        <p>A powerful admin dashboard template that especially build for developers and
                            programmers. DashLite comes with all kind of components.</p>
                        <ul class="header-action btns-inline py-3">
                            <li>
                                <a href="#" class="btn btn-primary btn-lg"><span>{{ __('Documentation') }}</span></a>
                            </li>
                            <li>
                                <a href="{{ route('login') }}" class="btn btn-danger btn-lg">
                                    <span>{{ ('Login') }}</span>
                                </a>
                            </li>
                        </ul><!-- .header-action -->
                        <ul class="header-icon list-inline pt-1">
                            <li><img class="h-20px" src="./images/icon/libs/javascript.png" alt=""></li>
                            <li><img class="h-20px" src="./images/icon/libs/sass.png" alt=""></li>
                            <li><img class="h-20px" src="./images/icon/libs/gulp.png" alt=""></li>
                            <li><img class="h-20px" src="./images/icon/libs/bootstrap.png" alt=""></li>
                            <li><img class="h-20px" src="./images/icon/libs/html5.png" alt=""></li>
                            <li><img class="h-20px" src="./images/icon/libs/css3.png" alt=""></li>
                        </ul>
                    </div><!-- .header-caption -->
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .header-content -->
</header><!-- .header -->