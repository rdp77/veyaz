@extends('layouts.backend.default')
@section('title', __('pages.title').__(' | Dashboard'))
@section('titleContent', __('pages.dashboard'))
@section('breadcrumb', __('Tanggal ').date('d-M-Y'))

@section('content')
@include('layouts.backend.components.notification')
<div class="card">
    <div class="card-header">
        <h4>{{ __("Server Monitor") }}</h4>
        <div class="card-header-action">
            <a href="{{ route('dashboard.server-monitor') }}" class="btn btn-danger">{{ __('pages.view') }} <i
                    class="fas fa-chevron-right"></i></a>
        </div>
    </div>
    <div class="card-body">
        <div class="mb-4">
            <div class="text-small float-right font-weight-bold text-muted">
                {{ $ram['used_memory_in_gb'] .__(' GB / ').
                $ram['total_ram'] .__(' GB (').$ram['memory'].__('%)') }}</div>
            <div class="font-weight-bold mb-1">{{ __('RAM') }}</div>
            <div class="progress" data-height="3" style="height: 3px;">
                <div class="progress-bar" role="progressbar" data-width="{{ $ram['memory'] }}%" aria-valuenow="25"
                    aria-valuemin="0" aria-valuemax="100" style="width: {{ $ram['memory'] }}%;"></div>
            </div>
        </div>
        <div class="mb-4">
            <div class="text-small float-right font-weight-bold text-muted">{{ $cpu['load'] }}</div>
            <div class="font-weight-bold mb-1">{{ __('CPU') }}</div>
            <div class="progress" data-height="3" style="height: 3px;">
                <div class="progress-bar" role="progressbar" data-width="{{ $cpu['load_width'] }}" aria-valuenow="25"
                    aria-valuemin="0" aria-valuemax="100" style="width: {{ $cpu['load_width'] }};"></div>
            </div>
        </div>
        <div class="mb-4">
            <div class="text-small float-right font-weight-bold text-muted">
                {{ $disk['disk_used_size'] .(' / ').$disk['total_disk_size'].__(' (').$disk['diskuse'].__('%)') }}
            </div>
            <div class="font-weight-bold mb-1">{{ __('Disk') }}</div>
            <div class="progress" data-height="3" style="height: 3px;">
                <div class="progress-bar" role="progressbar" data-width="{{ $disk['diskuse'] }}%" aria-valuenow="25"
                    aria-valuemin="0" aria-valuemax="100" style="width: {{ $disk['diskuse'] }}%;"></div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-info">
                <i class="far fa-user"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>{{ __('Total Admin') }}</h4>
                </div>
                <div class="card-body">
                    {{ $users }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
                <i class="far fa-list-alt"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>{{ __('Total Aktivitas') }}</h4>
                </div>
                <div class="card-body">
                    {{ $logCount }}
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
            @foreach($log as $l )
            <a href="javascript:void(0)" class="ticket-item">
                <div class="ticket-title">
                    <h4>{{ $l->info }}</h4>
                </div>
                <div class="ticket-info">
                    <div>{{ $l->ip }}</div>
                    <div class="bullet"></div>
                    <div class="text-primary">
                        {{ __('Tercatat pada tanggal ').date("d-M-Y", strtotime($l->added_at)).
                        __(' Jam ').date("H:m", strtotime($l->added_at)) }}
                    </div>
                </div>
            </a>
            @endforeach
            <a href="{{ route('dashboard.log') }}" class="ticket-item ticket-more">
                {{ __('Lihat Semua ') }} <i class="fas fa-chevron-right"></i>
            </a>
        </div>
    </div>
</div>
@endsection