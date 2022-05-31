@extends('layouts.backend.default')
@section('title', __('pages.title').__(' | ').__('Semua Aktivitas'))
@section('backToContent')
@include('pages.backend.components.backToContent',['url'=>route('dashboard')])
@endsection
@section('titleContent', __('Semua Aktivitas'))
@section('breadcrumb', __('pages.dashboard'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Aktivitas') }}</div>
<div class="breadcrumb-item active">{{ __('Semua') }}</div>
@endsection

@section('content')
@include('pages.backend.components.filterSearch')
<div class="card card-primary">
    <div class="card-body">
        <table class="table-striped table" id="table" width="100%">
            <thead>
                <tr>
                    <th class="text-center">
                        {{ __('NO') }}
                    </th>
                    <th>{{ __('Tanggal') }}</th>
                    <th>{{ __('Keterangan') }}</th>
                    <th>{{ __('URL') }}</th>
                    <th>{{ __('IP') }}</th>
                    <th>{{ __('User Agent') }}</th>
                    <th>{{ __('User') }}</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('script')
<script>
    var index = '{{ route('activity') }}';    
</script>
<script src="{{ asset('assets/pages/data/log/activity.js') }}"></script>
@endsection