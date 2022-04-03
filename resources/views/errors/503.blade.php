@extends('layouts.errors')

@section('title', __('Service Unavailable'))

@section('content')
<h1 class="nk-error-head">{{ __('503') }}</h1>
<h3 class="nk-error-title">{{ __($exception->getMessage() ?: 'Service Unavailable') }}</h3>
<p class="nk-error-text">We are very sorry for inconvenience. It looks like you’re try to access a page that either has
    been deleted or never existed.</p>
<a href="{{ url()->previous() }}" class="btn btn-lg btn-primary mt-2">{{ __('Back to previous page') }}</a>
@endsection