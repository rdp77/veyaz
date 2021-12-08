@extends('layouts.backend.default')
@section('title', __('pages.title').__(' | Edit Pengguna'))
@section('backToContent')
@include('pages.backend.components.backToContent',['url'=>route('users.index')])
@endsection
@section('titleContent', __('Edit Pengguna'))
@section('breadcrumb', __('Data'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Pengguna') }}</div>
<div class="breadcrumb-item active">{{ __('Edit Pengguna') }}</div>
@endsection

@section('content')
<div class="card">
    <form id="stored">
        <div class="card-body">
            <div class="form-group">
                <div class="d-block">
                    <label for="name" class="control-label">{{ __('Nama') }}<code>*</code></label>
                </div>
                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required
                    autofocus>
            </div>
            <div class="form-group">
                <label for="username">{{ __('Username') }}<code>*</code></label>
                <input id="username" type="text" class="form-control" name="username" value="{{ $user->username }}"
                    required autocomplete="username">
            </div>
        </div>
        <div class="card-footer text-right">
            <button class="btn btn-primary mr-1" onclick="update()" type="button">{{ __('pages.edit') }}</button>
        </div>
    </form>
</div>
@endsection
@section('script')
<script>
    var url = '{{ route('users.update',$user->id) }}';
    var index = '{{ route('users.index') }}';
</script>
<script src="{{ asset('assets/pages/stored.js') }}"></script>
@endsection