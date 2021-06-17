@extends('layouts.backend.default')
@section('title', __('pages.title').__(' | Edit Pengguna'))
@section('titleContent', __('Edit Pengguna'))
@section('breadcrumb', __('Master'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Pengguna') }}</div>
<div class="breadcrumb-item active">{{ __('Edit Pengguna') }}</div>
@endsection

@section('content')
<div class="card">
    <form method="POST" action="{{ route('users.update',$user->id) }}">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <div class="d-block">
                    <label for="name" class="control-label">{{ __('Nama') }}<code>*</code></label>
                </div>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ $user->name }}" required autofocus>
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="username">{{ __('Username') }}<code>*</code></label>
                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                    name="username" value="{{ $user->username }}" required autocomplete="username">
                @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="card-footer text-right">
            <button class="btn btn-primary mr-1" type="submit">{{ __('pages.edit') }}</button>
        </div>
    </form>
</div>
@endsection