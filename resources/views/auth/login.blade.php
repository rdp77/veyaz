@extends('layouts.auth')
@section('title', __('pages.title').__(' | ').__('title.login'))

@section('content')
<form method="POST" action="{{ route('login') }}" class="needs-validation">
    @csrf
    @error('user')
    <div class="alert alert-danger alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>×</span>
            </button>
            {{ $message }}
        </div>
    </div>
    @enderror
    @error('login')
    <div class="alert alert-danger alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>×</span>
            </button>
            {{ $message }}
        </div>
    </div>
    @enderror
    <div class="form-group">
        <label for="login">{{ __('Username atau Email') }}</label>
        <input id="login" type="text" class="form-control @error('login') is-invalid @enderror" name="login"
            tabindex="1" required autocomplete="username" autofocus>
    </div>

    <div class="form-group">
        <div class="d-block">
            <label for="password" class="control-label">{{ __('auth.password') }}</label>
        </div>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
            name="password" tabindex="2" required autocomplete="current-password">
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