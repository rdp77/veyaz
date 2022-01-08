@extends('layouts.backend.default')
@section('title', __('pages.title').__(' | ').__('Server Monitor'))
@section('backToContent')
@include('pages.backend.components.backToContent',['url'=>route('dashboard')])
@endsection
@section('titleContent', __('Server Monitor'))
@section('breadcrumb', __('pages.dashboard'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Server Monitor') }}</div>
@endsection

@section('content')
@if (isset($checkResults['counts']))
<h2 class="section-title">{{ __('Last Checked') }}</h2>
<p class="section-lead">
    {{ $lastRun.__(' via ').$checkResults['via'] }}
</p>
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-success">
                <i class="fas fa-check"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>{{ __('PASSED') }}</h4>
                </div>
                <div class="card-body">
                    {{ $checkResults['counts']['passed_checks_count'] }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
                <i class="fas fa-times"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>{{ __('FAILED') }}</h4>
                </div>
                <div class="card-body">
                    {{ $checkResults['counts']['failed_checks_count'] }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-info">
                <i class="fas fa-tasks"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>{{ __('TOTAL') }}</h4>
                </div>
                <div class="card-body">
                    {{ $checkResults['counts']['total_checks_count'] }}
                </div>
            </div>
        </div>
    </div>
</div>
@php
unset($checkResults['counts'], $checkResults['via'])
@endphp
@endif
<div class="card card-primary card-progress-dismiss" id="data">
    <div class="card-header">
        <h4>{{ __("Report Server Monitor") }}</h4>
        <div class="card-header-action">
            <button id="btnRefresh" type="submit" class="btn btn-primary">{{ __('Run All Checks') }}
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <table class="table-bordered table-hover table" id="table" width="100%">
            <thead class="text-center">
                <tr>
                    <th class="text-center" style="width: 40px;">{{ __('#') }}</th>
                    <th>{{ __('Check Name') }}</th>
                    <th class="text-center" style="width: 50px;">{{ __('Time') }}</th>
                    <th class="text-center" style="width: 150px;">{{ __('Status') }}</th>
                    <th class="text-center" style="width: 50px;">{{ __('Run') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($checkResults as $type => $checks)
                <tr>
                    <td colspan="5" class="text-center text-dark text-uppercase table-active">
                        <strong>{{ Str::replace('.', ' ', $type) }}</strong>
                    </td>
                </tr>
                @foreach($checks as $index => $check)
                <tr>
                    <td class="text-center">
                        {{ ++$index }}
                    </td>
                    <td class="font-weight-bold">
                        {{ $check['name'] }}
                    </td>
                    <td class="text-center">
                        <i>{{ $check['time'] }}</i>
                    </td>
                    @php
                    $isOk = $check['status'] == 1;
                    $text = $isOk ? 'Passed' : 'Failed';
                    $icon = $isOk ? 'success' : 'danger';
                    $popover = $isOk ? '' : 'tabindex="0" data-toggle="popover" data-trigger="focus" title="Error
                    Details" data-content="' . $check['error'] . '"';

                    echo "<td class='text-center'><span style='font-size: 12px; padding-bottom:6px;' ' . $popover . '
                            class='col-sm-10 badge badge-$icon'>$text</span></td>";
                    @endphp
                    <td class='text-center'>
                        <span class="btn btn-info btn-md refresh" data-checker="{{ $check['checker'] }}"
                            data-toggle="tooltip" data-placement="top" title="Run this check"
                            style="font-size: 10px;cursor: pointer;">
                            <i class="fas fa-play"></i>
                        </span>
                    </td>
                </tr>
                @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('script')
<script>
    window.ServerMonitorRefreshUrl = "{{ route('dashboard.server-monitor.refresh') }}";
    window.ServerMonitorRefreshAllUrl = "{{ route('dashboard.server-monitor.refreshAll') }}";
</script>
<script src="{{ asset('assets/pages/data/server/index.js') }}"></script>
@endsection