@extends('layouts.frontend.default')
@section('title', __('pages.title'))
@section('titleContent', __('auth.login'))

@section('content')
<div class="row">
    <div class="col">
        <a href="{{ route('login') }}" class="btn btn-icon icon-left btn-md btn-round btn-dark">
            <i class="fas fa-sign-in-alt"></i>
            {{ __('auth.login') }}
        </a>
    </div>
    <div class="col">
        <a href="{{ route('register') }}" class="col btn btn-icon icon-left btn-md btn-round btn-dark">
            <i class="fas fa-user-plus"></i>
            {{ __('auth.register') }}
        </a>
    </div>

</div>
<a href="{{ route('about') }}" class="btn btn-block btn-round btn-light mt-3">
    {{ __('pages.about') }}
</a>
@endsection