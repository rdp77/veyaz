@extends('layouts.backend.default')
@section('title', __('pages.title').__(' | Ganti Password'))
@section('titleContent', __('Ganti Password'))
@section('breadcrumb', __('Dashboard'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Ganti Password') }}</div>
@endsection

@section('content')
<div class="card">
    <form method="POST" action="{{ route('changePassword') }}">
        @csrf
        @method('post')
        <div class="card-body">
            @if (Session::has('status'))
            <div class="alert alert-danger alert-has-icon">
                <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                <div class="alert-body">
                    <div class="alert-title">{{ __('Error') }}</div>
                    {{ Session::get('status') }}
                </div>
            </div>
            @endif
            <div class="form-group">
                <label>{{ __('Username') }}</label>
                <input id="username" type="username" class="form-control @error('username') is-invalid @enderror"
                    value="{{ old('username') }}" name="username" required autocomplete="username" autofocus>
                @error('username')
                <span class="text-danger" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label>{{ __('Password lama') }}</label>
                <input id="oldPassword" type="password" class="form-control @error('oldPassword') is-invalid @enderror"
                    name="oldPassword" required>
                @error('oldPassword')
                <span class="text-danger" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label>{{ __('Password Baru') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required>
                @error('password')
                <span class="text-danger" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
        </div>
        <div class="card-footer text-right">
            <button class="btn btn-primary mr-1" type="submit">{{ __('Ganti Password') }}</button>
        </div>
    </form>
</div>
@endsection