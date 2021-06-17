@extends('layouts.frontend.default')

@section('title', 'Home')

@section('css')
<link rel="stylesheet" href="{{ asset('halaman/Guest/homeGuest/homeGuest.styles.css') }}">
@endsection

@section('content')

{{ $article }}
<div class="marquee">
    <h1 class="mt-3">{{ __('Selamat Datang di Web Melia Transport') }}</h1>
</div>
<div class="mt-4 background">
    <div class="trans" style="border-radius: 15px">
        <div class="container mt-2">
            <h4 style="color: white">Laman Berita Home</h4>
        </div>
    </div>
</div>
<div class="container mt-3">
    @include('frontend.layouts.components.share')
</div>
<div class="mt-4">
    <div class="container">

    </div>
</div>
@endsection