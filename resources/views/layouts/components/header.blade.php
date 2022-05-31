<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title')</title>
    @auth
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @endauth

    <!-- Meta for browser -->
    <meta charset='UTF-8' />
    <meta content="@yield('title')" name='copyright' />
    <meta content='width=device-width, initial-scale=1, user-scalable=1, minimum-scale=1, maximum-scale=5'
        name='viewport' />
    <meta content='IE=edge' http-equiv='X-UA-Compatible' />
    <meta content='max-image-preview:large' name='robots' />

    <!-- Favicon -->
    <link href="{{ asset('icons/favicon.ico') }}" rel="shortcut icon" type=image/x-icon>
    <link href="{{ asset('icons/apple-icon-precomposed.png') }}" rel='apple-touch-icon' />
    <link href="{{ asset('icons/apple-icon-57x57.png') }}" rel='apple-touch-icon' sizes='57x57' />
    <link href="{{ asset('icons/apple-icon-72x72.png') }}" rel='apple-touch-icon' sizes='72x72' />
    <link href="{{ asset('icons/apple-icon-76x76.png') }}" rel='apple-touch-icon' sizes='76x76' />
    <link href="{{ asset('icons/apple-icon-144x144.png') }}" rel='apple-touch-icon' sizes='114x114' />
    <link href="{{ asset('icons/apple-icon-120x120.png') }}" rel='apple-touch-icon' sizes='120x120' />
    <link href="{{ asset('icons/apple-icon-144x144.png') }}" rel='apple-touch-icon' sizes='144x144' />
    <link href="{{ asset('icons/apple-icon-152x152.png') }}" rel='apple-touch-icon' sizes='152x152' />
    <link href="{{ asset('icons/apple-icon-180x180.png') }}" rel='apple-touch-icon' sizes='180x180' />
    <link href="{{ asset('icons/android-icon-192x192.png') }}" rel='icon' sizes='192x192' type='image/png' />
    <link href="{{ asset('icons/favicon-96x96.png') }}" rel='icon' sizes='96x96' type='image/png' />
    <link href="{{ asset('icons/favicon-32x32.png') }}" rel='icon' sizes='32x32' type='image/png' />
    <link href="{{ asset('icons/ms-icon-310x310.png') }}" rel='msapplication-TitleImage' />
    <link rel="manifest" href="{{ asset('icons/manifest.json') }}">
    <meta name="msapplication-config" content="{{ asset('icons/browserconfig.xml') }}" />

    <!-- Theme Color -->
    <meta content='#3a455c' name='theme-color' />
    <meta content='#3a455c' name='msapplication-navbutton-color' />
    <meta content='#3a455c' name='apple-mobile-web-app-status-bar-style' />
    <meta content='true' name='apple-mobile-web-app-capable' />

    <!-- Icon -->
    <link href="{{ asset('favicon.ico') }}" rel="shortcut icon" type=image/x-icon>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSS Libraries & Template -->
    <link rel="stylesheet" href="{{ mix('assets/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css"
        integrity="sha512-O03ntXoVqaGUTAeAmvQ2YSzkCvclZEcPQu1eqloPaHfJ5RuNGiS4l+3duaidD801P50J28EHyonCV06CUlTSag=="
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.6/min/dropzone.min.css"
        integrity="sha512-WvVX1YO12zmsvTpUQV8s7ZU98DnkaAokcciMZJfnNWyNzm7//QRV61t4aEr0WdIa4pe854QHLTV302vH92FSMw=="
        crossorigin="anonymous" />
</head>