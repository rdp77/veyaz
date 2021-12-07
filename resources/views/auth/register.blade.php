@extends('layouts.auth')
@section('title', __('pages.title').__(' | ').__('title.register'))

@section('content')
<form method="POST" action="{{ route('register') }}" class="needs-validation">
    @csrf
    <div class="form-group">
        <label for="username">{{ __('pages.name') }}</label>
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" tabindex="1"
            value="{{ old('name') }}" required autocomplete="name" autofocus>
        @if(Session::has('error'))
        <div class="invalid-feedback">
            {{ Session::get('error') }}
        </div>
        @endif
        @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="username">{{ __('auth.username') }}</label>
        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username"
            tabindex="2" value="{{ old('username') }}" required autocomplete="username">
        @if(Session::has('error'))
        <div class="invalid-feedback">
            {{ Session::get('error') }}
        </div>
        @endif
        @error('username')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="row">
        <div class="form-group col-6">
            <div class="d-block">
                <label for="password" class="control-label">{{ __('auth.password') }}</label>
            </div>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" tabindex="3" required autocomplete="current-password">
            @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group col-6">
            <label for="password-confirm" class="control-label">{{ __('Ulangi Password') }}</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                autocomplete="new-password">
            @error('password_confirmation')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" name="agree" class="custom-control-input" id="agree">
            <label class="custom-control-label" for="agree">{{ __('auth.terms') }}</label>
        </div>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
            {{ __('auth.register') }}
        </button>
    </div>
</form>
@endsection