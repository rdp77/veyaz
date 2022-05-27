<footer class="footer bg-lighter" id="footer">
    <div class="container">
        <div class="row g-3 align-items-center justify-content-md-between py-4 py-md-5">
            <div class="col-md-3">
                <div class="footer-logo">
                    <a href="html/index.html" class="logo-link">
                        <img class="logo-light logo-img" src="./images/logo.png" srcset="./images/logo2x.png 2x"
                            alt="logo">
                        <img class="logo-dark logo-img" src="./images/logo-dark.png"
                            srcset="./images/logo-dark2x.png 2x" alt="logo-dark">
                    </a>
                </div><!-- .footer-logo -->
            </div><!-- .col -->
            <div class="col-md-9 d-flex justify-content-md-end">
                <ul class="link-inline gx-4">
                    <li>
                        <a href="#">{{ __('Get Started') }}</a>
                    </li>
                    <li>
                        <a href="https://github.com/rdp77/veyaz" target="_blank">{{ __('Download') }}</a>
                    </li>
                    <li>
                        <a href="https://github.com/rdp77/veyaz/issues" target="_blank">{{ __('Support') }}</a>
                    </li>
                </ul><!-- .footer-nav -->
            </div><!-- .col -->
        </div>
        <hr class="hr border-light mb-0 mt-n1">
        <div class="row g-3 align-items-center justify-content-md-between py-4">
            <div class="col-md-8">
                @include('layouts.components.credit')
            </div><!-- .col -->
            <div class="col-md-4 d-flex justify-content-md-end">
                <ul class="social">
                    <li>
                        <a href="https://www.linkedin.com/company/wreative/" target="_blank"><em
                                class="icon ni ni-linkedin"></em>
                        </a>
                    </li>
                    <li>
                        <a href="https://web.facebook.com/wreative" target="_blank"><em
                                class="icon ni ni-facebook-f"></em>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.instagram.com/wreative/" target="_blank"><em
                                class="icon ni ni-instagram"></em>
                        </a>
                    </li>
                    <li>
                        <a href="https://link.wreative.com/youtube" target="_blank"><em
                                class="icon ni ni-youtube-fill"></em>
                        </a>
                    </li>
                </ul><!-- .footer-icon -->
            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .container -->
</footer><!-- .footer -->