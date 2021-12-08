@extends('layouts.backend.default')
@section('title', __('pages.title').__(' | Data Pengguna'))
@section('titleContent', __('Pengguna'))
@section('breadcrumb', __('Data'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Pengguna') }}</div>
@endsection

@section('content')
@include('pages.backend.components.filterSearch')
@include('layouts.backend.components.notification')
<div class="card">
    <div class="card-header">
        <a href="{{ route('users.create') }}" class="btn btn-icon icon-left btn-primary mr-2">
            <i class="far fa-edit"></i>{{ __(' Tambah Pengguna') }}
        </a>
        <a href="{{ route('users.recycle') }}" class="btn btn-icon icon-left btn-danger">
            <i class="far fa-trash-alt"></i>{{ __('Recycle Bin') }}
        </a>
    </div>
    <div class="card-body">
        <table class="table-striped table" id="table" width="100%">
            <thead>
                <tr>
                    <th>
                        {{ __('Username') }}
                    </th>
                    <th>{{ __('Nama') }}</th>
                    <th>{{ __('Aksi') }}</th>
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
    var index = '{{ route('users.index') }}';    
</script>
<script src="{{ asset('assets/pages/data/users/index.js') }}"></script>
@endsection