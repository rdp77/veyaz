@extends('layouts.frontend.default')
@section('title', __('pages.title'))
@section('titleContent', __('auth.login'))

@section('content')
@include('layouts.frontend.components.header')
@include('layouts.frontend.components.feature')
@include('layouts.frontend.components.callToAction')
@include('layouts.frontend.components.footer')
@endsection