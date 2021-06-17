@extends('layouts.frontend.default')

@section('title', 'Paket Wisata Pacitan')

@section('css')
<link rel="stylesheet" href="{{ asset('halaman/Guest/homeGuest/homeGuest.styles.css') }}">

@endsection

@section('content')
<div class="mt-4 background">
    <div class="trans" style="border-radius: 15px">
        <div class="container mt-2">
            <h4 style="color: white">{{ __('Daftar Tarif Harga Paket Tour Wisata Pacitan') }}</h4>
        </div>
    </div>
</div>
<div class="container mt-3">
    @include('layouts.frontend.components.share')
</div>
<div class="mt-4">
    <div class="container">
        @if (count($post) > 0)
        <div class="row mt-4">
            @foreach ($post as $p)
            <div class="col">
                @include('pages.frontend.components.card', ['img' => $p->img, 'title' => $p->title,
                'desc' => $p->desc, 'link'=>$p->link, 'btn' => 'Lihat Selengkapnya'])
            </div>
            @endforeach
        </div>
        @else
        <h3 class="text-center">{{ __('Tidak Ada Artikel') }}</h3>
        @endif
    </div>
</div>
@endsection