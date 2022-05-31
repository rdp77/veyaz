@extends('layouts.backend.default')
@section('title', __('pages.title').__(' | ').__('pages.history'))
@section('backToContent')
@include('pages.backend.components.backToContent',['url'=>route('dashboard')])
@endsection
@section('titleContent', __('Aksi Aktivitas'))
@section('breadcrumb', __('pages.dashboard'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Aktivitas') }}</div>
<div class="breadcrumb-item active">{{ __('List') }}</div>
@endsection

@section('content')
@include('pages.backend.components.filterSearch')
<div class="card">
    <div class="card-header">
        <button id="modal" class="btn btn-icon icon-left btn-primary mr-2">
            <i class="far fa-edit"></i>{{ __(' Tambah Aktivitas') }}
        </button>
    </div>
    <div class="card-body">
        <table class="table-striped table" id="table" width="100%">
            <thead>
                <tr>
                    <th class="text-center">
                        {{ __('NO') }}
                    </th>
                    <th>{{ __('Aksi') }}</th>
                    <th>{{ __('Tipe') }}</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('modal')
@include('pages.backend.log.components.modalActivity')
@endsection
@section('script')
<script>
    var index = '{{ route('activity.list.index') }}';    
    var store = '{{ route('activity.list.store') }}';    
</script>
<script src="{{ asset('assets/pages/data/log/activity-list.js') }}"></script>
@endsection