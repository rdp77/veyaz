@extends('layouts.backend.default')
@section('title', __('pages.title').__(' | Tambah Pengguna'))
@section('backToContent')
@include('pages.backend.components.backToContent',['url'=>route('users.index')])
@endsection
@section('titleContent', __('Tambah Pengguna'))
@section('breadcrumb', __('Data'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Pengguna') }}</div>
<div class="breadcrumb-item active">{{ __('Tambah Pengguna') }}</div>
@endsection

@section('content')
<div class="card">
    <form id="stored">
        <div class="card-body">
            <div class="form-group">
                <div class="d-block">
                    <label for="name" class="control-label">{{ __('Nama') }}<code>*</code></label>
                </div>
                <input id="name" type="text" class="form-control" name="name" autofocus>
            </div>
            <div class="form-group">
                <label for="username">{{ __('Username') }}<code>*</code></label>
                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}"
                    autocomplete="username">
            </div>
            <div class="form-group">
                <div class="d-block">
                    <label for="password" class="control-label">{{ __('Password') }}<code>*</code></label>
                </div>
                <input id="password" type="password" class="form-control" name="password"
                    autocomplete="current-password">
            </div>
            <div class="form-group">
                <label for="password-confirm" class="control-label">{{ __('Ulangi Password') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                    autocomplete="new-password">
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary mr-1" type="button" onclick="save()">{{ __('Tambah') }}</button>
            </div>
        </div>
    </form>
</div>
@endsection
@section('script')
<script>
    var url = '{{ route('users.store') }}';
    var index = '{{ route('users.index') }}';
</script>
<script src="{{ asset('assets/pages/stored.js') }}"></script>
@endsection