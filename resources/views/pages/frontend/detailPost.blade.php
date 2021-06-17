@extends('layouts.frontend.default')

@section('title', 'Home')

@section('css')
<link rel="stylesheet" href="{{ asset('halaman/Guest/homeGuest/homeGuest.styles.css') }}">
@endsection

@section('content')
<div class="marquee">
    <h1 class="mt-3">{{ __('Selamat Datang di Web Melia Transport') }}</h1>
</div>
<div class="mt-4 background">
    <div class="trans" style="border-radius: 15px">
        <div class="container mt-2">
            <h4 style="color: white">{{ $post->title }}</h4>
        </div>
    </div>
</div>
<div class="container mt-3">
    @include('layouts.frontend.components.share')
</div>
<div class="mt-4">
    <div class="container">
        <img class="img-thumbnail img-fluid mx-auto d-block" src="{{ asset('thumb') . '/' . $post->img }}">
        <div class="card-body">
            <div class="card-text text-light">
                <p>
                    {!! $post->desc !!}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection