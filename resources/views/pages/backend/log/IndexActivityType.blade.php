@extends('layouts.backend.default')
@section('title', __('pages.title').__(' | ').__('Tipe Aktivitas'))
@section('backToContent')
@include('pages.backend.components.backToContent',['url'=>route('dashboard')])
@endsection
@section('titleContent', __('Tipe Aktivitas'))
@section('breadcrumb', __('pages.dashboard'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Aktivitas') }}</div>
<div class="breadcrumb-item active">{{ __('Tipe') }}</div>
@endsection

@section('content')
@include('pages.backend.components.filterSearch')
<div class="card">
    <div class="card-header">
        <button id="modal" class="btn btn-icon icon-left btn-primary mr-2">
            <i class="far fa-edit"></i>{{ __(' Tambah Tipe') }}
        </button>
    </div>
    <div class="card-body">
        <table class="table-striped table" id="table" width="100%">
            <thead>
                <tr>
                    <th class="text-center">
                        {{ __('NO') }}
                    </th>
                    <th>{{ __('Nama') }}</th>
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
    var index = '{{ route('activity.type.index') }}'; 
    var store = '{{ route('activity.type.store') }}';    
</script>
<script src="{{ asset('assets/pages/data/log/activity-type.js') }}"></script>
@endsection