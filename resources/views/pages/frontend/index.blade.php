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
            <h4 style="color: white">{{ __('Laman Berita Home') }}</h4>
        </div>
    </div>
</div>
<div class="container mt-3">
    @include('layouts.frontend.components.share')
</div>
<div class="mt-4">
    <div class="container">
        @if (count($post) > 0)
        @include('pages.frontend.components.card', ['img' =>$randomPost['img'],
        'title'=>$randomPost['title'],
        'desc'=>$randomPost['desc'],'link'=>$randomPost['slug'],'btn'=>'Lihat Selengkapnya'])
        <div class="row mt-4">
            @foreach ($post as $p)
            <div class="col">
                @include('pages.frontend.components.card', ['img' => $p->img, 'title' => $p->title,
                'desc' => $p->desc, 'link'=>$p['slug'],'btn' => 'Lihat Selengkapnya'])
            </div>
            @endforeach
        </div>
        @else
        <h3 class="text-center">{{ __('Tidak Ada Artikel') }}</h3>
        @endif
    </div>
</div>
@endsection