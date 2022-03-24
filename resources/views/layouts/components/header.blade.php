<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>@yield('title')</title>
    @auth
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @endauth

    <!-- Meta for browser -->
    <meta charset='UTF-8' />
    {!! SEOMeta::generate() !!}
    <meta content="@yield('title')" name='copyright' />
    <meta content='width=device-width, initial-scale=1, user-scalable=1, minimum-scale=1, maximum-scale=5'
        name='viewport' />
    <meta content='IE=edge' http-equiv='X-UA-Compatible' />
    <meta content='max-image-preview:large' name='robots' />

    <!-- Browser data, description and keyword -->
    <meta
        content='Kumpulan tutorial yang membahas Android, Windows, Linux Debian atau Ubuntu, Networking atau Mikrotik, Software dan Informasi secara lengkap dan jelas.'
        name='description' />
    <meta content='Backup Otak, , Keyword_1, Keyword_2, Keyword_3 ' name='keywords' />

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

    <!-- Open graph -->
    {!! OpenGraph::generate() !!}

    <meta content="@yield('title')" property='og:title' />
    <meta content="{{ URL::to('/') }}" property='og:url' />
    <meta content="@yield('title')" property='og:site_name' />
    <meta content='website' property='og:type' />
    <meta content='Admin Dashboard Template based on Laravel' property='og:description' />
    <meta content="@yield('title')" property='og:image:alt' />
    <meta
        content='https://cdn.statically.io/img/1.bp.blogspot.com/-rj-7RPURZFg/XuBc3hv6RKI/AAAAAAAAEmU/Q0BRt5h3O7czRpKtCy4DLpSCQCGY3odOACK4BGAsYHg/s1600/Backup%2BOtak%2BNo%2BWatermark.png'
        property='og:image' />

    <!-- Twitter Card -->
    {!! Twitter::generate() !!}

    <meta content="@yield('title')" name='twitter:title' />
    <meta content="{{ URL::to('/') }}" name='twitter:url' />
    <meta content='Admin Dashboard Template based on Laravel' name='twitter:description' />
    <meta content='summary_large_image' name='twitter:card' />
    <meta content="@yield('title')" name='twitter:image:alt' />
    <meta
        content='https://cdn.statically.io/img/1.bp.blogspot.com/-rj-7RPURZFg/XuBc3hv6RKI/AAAAAAAAEmU/Q0BRt5h3O7czRpKtCy4DLpSCQCGY3odOACK4BGAsYHg/s1600/Backup%2BOtak%2BNo%2BWatermark.png'
        name='twitter:image:src' />

    <!-- Meta Robots Search -->
    <meta content='text/html; charset=UTF-8' http-equiv='Content-Type' />
    <meta content='all-language' http-equiv='Content-Language' />
    <meta content='IE=Edge' http-equiv='X-UA-Compatible' />
    <meta content='Indonesia' name='geo.placename' />
    <meta content='id' name='geo.country' />
    <meta content='ID-BT' name='geo.region' />
    <meta content='en' name='language' />
    <meta content='global' name='target' />
    <meta content='global' name='distribution' />
    <meta content='general' name='rating' />
    <meta content='1 days' name='revisit-after' />
    <meta content='true' name='MSSmartTagsPreventParsing' />
    <meta content='index, follow' name='googlebot' />
    <meta content='follow, all' name='Googlebot-Image' />
    <meta content='follow, all' name='msnbot' />
    <meta content='follow, all' name='Slurp' />
    <meta content='follow, all' name='ZyBorg' />
    <meta content='follow, all' name='Scooter' />
    <meta content='all' name='spiders' />
    <meta content='all' name='WEBCRAWLERS' />
    <meta
        content='aeiwi, alexa, alltheWeb, altavista, aol netfind, anzwers, canada, directhit, euroseek, excite, overture, go, google, hotbot. infomak, kanoodle, lycos, mastersite, national directory, northern light, searchit, simplesearch, Websmostlinked, webtop, what-u-seek, aol, yahoo, webcrawler, infoseek, excite, magellan, looksmart, bing, cnet, googlebot'
        name='search engines' />

    <!-- Meta Owner -->
    <meta content="{{ env('DEVELOPER_FULLNAME') }}" name='Author' />
    <link href="{{ env('DEVELOPER_WEBSITE') }}" rel='me' />
    <link href="{{ env('DEVELOPER_WEBSITE') }}" rel='author' />
    <link href="{{ env('DEVELOPER_WEBSITE') }}" rel='publisher' />
    <meta content='#' property='fb:admins' />
    <meta content='#' property='fb:pages' />
    <meta content='#' property='fb:app_id' />
    <meta content='#' property='article:author' />
    <meta content='#' property='article:publisher' />
    <meta content='{{ env(' TWITTER_USERNAME') }}' name='twitter:site' />
    <meta content='{{ env(' TWITTER_USERNAME') }}' name='twitter:creator' />

    <!-- JSON-LD Schema -->
    {!! JsonLd::generate() !!}

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('css/dashlite.css') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('css/theme.css') }}">
</head>