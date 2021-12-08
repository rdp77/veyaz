@extends('layouts.backend.default')
@section('title', __('pages.title').__(' | ').__('pages.history'))
@section('backToContent')
@include('pages.backend.components.backToContent',['url'=>route('dashboard.log')])
@endsection
@section('titleContent', __('pages.history'))
@section('breadcrumb', __('pages.dashboard'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('pages.history') }}</div>
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
    var index = '{{ route('dashboard.log') }}';    
</script>
<script src="{{ asset('assets/pages/data/log/index.js') }}"></script>
@endsection