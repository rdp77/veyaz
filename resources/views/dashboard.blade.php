@extends('layouts.backend.default')
@section('title', __('pages.title').__(' | Dashboard'))
@section('titleContent', __('Dashboard'))
@section('breadcrumb', __('Tanggal ').date('d-M-Y'))

@section('content')
@if(Session::has('status'))
<div class="alert alert-danger alert-has-icon">
    <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
    <div class="alert-body">
        <div class="alert-title">{{ __('Informasi') }}</div>
        {{ Session::get('status') }}
    </div>
</div>
@endif
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
                <i class="far fa-user"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>{{ __('Total Admin') }}</h4>
                </div>
                <div class="card-body">
                    {{ __('10') }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
                <i class="far fa-newspaper"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>{{ __('News') }}</h4>
                </div>
                <div class="card-body">
                    {{ __('42') }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
                <i class="far fa-file"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>{{ __('Reports') }}</h4>
                </div>
                <div class="card-body">
                    {{ __('1,201') }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-success">
                <i class="fas fa-circle"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>{{ __('Online Users') }}</h4>
                </div>
                <div class="card-body">
                    {{ __('47') }}
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
        <h4>{{ __('pages.history') }}</h4>
        <div class="card-description">
            {{ __('pages.historyDesc') }}
        </div>
    </div>
    <div class="card-body p-0">
        <div class="tickets-list">
            {{-- @foreach($history as $s )
            <a href="javascript:void(0)" class="ticket-item">
                <div class="ticket-title">
                    <h4>{{ $s->info }}</h4>
        </div>
        <div class="ticket-info">
            <div>{{ $s->relationUser->name }}</div>
            <div class="bullet"></div>
            <div class="text-primary">
                {{ __('Tercatat pada tanggal ').date("d-M-Y", strtotime($s->date)) }}
            </div>
        </div>
        </a>
        @endforeach --}}
        {{-- <a href="{{ route('history.index') }}" class="ticket-item ticket-more">
        {{ __('Lihat Semua ') }} <i class="fas fa-chevron-right"></i>
        </a> --}}
    </div>
</div>
</div>
@endsection