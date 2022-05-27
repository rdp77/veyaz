@extends('layouts.errors')

@section('title', __('Not Found'))

@section('content')
<img class="nk-error-gfx" src="{{ asset('images/errors/404.svg') }}">
<div class="wide-xs mx-auto">
    <h3 class="nk-error-title">{{ __('Oops! Why you’re here?') }}</h3>
    <p class="nk-error-text">
        {{ __('We are very sorry for inconvenience. It looks like you’re try to access a page that either
        has been deleted or never existed.') }}
    </p>
    <a href="{{ URL::to('/') }}" class="btn btn-lg btn-primary mt-2">{{ __('Back To Home') }}</a>
</div>
@endsection