<nav class="navbar navbar-expand-lg navbar-light shadow-sm" style="background-color: white !important;">
    <a class="navbar-brand" href="/">
        <img src="/images/melialogo.jpg" width="130" height="50" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home.index') }}">Home<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home.profile') }}">Profil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home.car') }}">Sewa Mobil</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ __('Paket Wisata') }}
                </a>
                <div class="dropdown-menu slide" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('home.travel.bandung') }}">
                        {{ __('Paket Tour Wisata Bandung') }}
                    </a>
                    <a class="dropdown-item" href="{{ route('home.travel.banyuwangi') }}">
                        {{ __('Paket Tour Wisata Banyuwangi') }}
                    </a>
                    <a class="dropdown-item" href="{{ route('home.travel.banyuwangi') }}">
                        {{ __('Paket Tour Wisata Jogjakarta') }}
                    </a>
                    <a class="dropdown-item" href="{{ route('home.travel.malang') }}">
                        {{ __('Paket Tour Wisata Malang') }}
                    </a>
                    <a class="dropdown-item" href="{{ route('home.travel.pacitan') }}">
                        {{ __('Paket Tour Wisata Pacitan') }}
                    </a>
                    <a class="dropdown-item" href="{{ route('home.travel.semarang') }}">
                        {{ __('Paket Tour Wisata Semarang') }}
                    </a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home.testimonial') }}">{{ __('Testimonial') }}</a>
            </li>

        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="" aria-label="Pencarian">
            <button class="btn btn-dark my-2 my-sm-0" type="submit">Pencarian</button>
        </form>
    </div>
</nav>