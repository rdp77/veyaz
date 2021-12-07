@extends('layouts.auth')
@section('title', __('pages.title').__(' | ').__('title.login'))

@section('content')
<form method="POST" action="{{ route('login') }}" class="needs-validation">
    @csrf
    <div class="form-group">
        <label for="username">{{ __('auth.username') }}</label>
        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username"
            tabindex="1" value="{{ old('username') }}" required autocomplete="username" autofocus>
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

    <div class="form-group">
        <div class="d-block">
            <label for="password" class="control-label">{{ __('auth.password') }}</label>
        </div>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
            name="password" tabindex="2" required autocomplete="current-password">
        @error('password')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form-group">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
            <label class="custom-control-label" for="remember-me">{{ __('auth.remember') }}</label>
        </div>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
            {{ __('auth.login') }}
        </button>
    </div>
</form>
@endsection
@section('script')
@if(Session::has('status'))
<script type="text/javascript">
    iziToast.info({
    title: 'Informasi',
    message: '{{ Session::get('status') }}',
    position: 'topRight',
});
</script>
@endif
@endsection