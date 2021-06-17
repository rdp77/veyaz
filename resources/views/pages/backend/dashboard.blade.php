@extends('layouts.backend.default')
@section('title', __('pages.title') . __(' | Dashboard'))
@section('titleContent', __('Dashboard'))
@section('breadcrumb', __('Tanggal ') . date('d-M-Y'))

@section('content')
@if (Session::has('status'))
<div class="alert alert-primary alert-has-icon">
    <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
    <div class="alert-body">
        <div class="alert-title">{{ __('Informasi') }}</div>
        {{ Session::get('status') }}
    </div>
</div>
@endif
<div class="row">
    <div class="col">
        <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
                <i class="far fa-newspaper"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>{{ __('Jumlah Artikel') }}</h4>
                </div>
                <div class="card-body">
                    {{ $articles }}
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
                <i class="fas fa-users"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>{{ __('Jumlah Admin') }}</h4>
                </div>
                <div class="card-body">
                    {{ $adm }}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card card-hero">
    <div class="card-header">
        <div class="card-icon">
            <i class="fas fa-history"></i>
        </div>
        <h4>{{ __('History') }}</h4>
        <div class="card-description">{{ __('Riwayat yang kamu lakukan selama ini') }}</div>
    </div>
    <div class="card-body p-0">
        <div class="tickets-list">
            @foreach ($log as $l)
            <a href="javascript:void(0)" class="ticket-item">
                <div class="ticket-title">
                    <h4>{{ $l->info }}</h4>
                </div>
                <div class="ticket-info">
                    <div>{{ $l->name }}</div>
                    <div class="bullet"></div>
                    <div class="text-primary">
                        {{ __('Tercatat pada tanggal ') . date('d-M-Y', strtotime($l->datetime)). __(' Jam ') . date('H:i', strtotime($l->datetime)) }}
                    </div>
                </div>
            </a>
            @endforeach
            <a href="{{ route('admin.log') }}" class="ticket-item ticket-more">
                {{ __('Lihat Semua ') }} <i class="fas fa-chevron-right"></i>
            </a>
        </div>
    </div>
</div>
@endsection