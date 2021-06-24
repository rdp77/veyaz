@extends('layouts.default')
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
    <div class="col">
        <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
                <i class="fas fa-exchange-alt"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>{{ __('Total Alat Produksi') }}</h4>
                </div>
                <div class="card-body">
                    {{-- {{ $production }} --}}
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
                <i class="fas fa-boxes"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>{{ __('Total Perlengkapan') }}</h4>
                </div>
                <div class="card-body">
                    {{-- {{ $equipment }} --}}
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card card-statistic-1">
            <div class="card-icon bg-info">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>{{ __('Total Persewaan Gedung') }}</h4>
                </div>
                <div class="card-body">
                    {{-- {{ $rental }} --}}
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card card-statistic-1">
            <div class="card-icon bg-success">
                <i class="fas fa-users"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>{{ __('Total Kendaraan') }}</h4>
                </div>
                <div class="card-body">
                    {{-- {{ $vehicle }} --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection