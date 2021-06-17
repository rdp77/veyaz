@extends('layouts.frontend.default')

@section('title', 'Testimonial')

@section('css')
{{-- <link rel="stylesheet" href="{{ asset('halaman/Guest/homeGuest/homeGuest.styles.css') }}"> --}}
@endsection

@section('testimonial')
<div class="mt-4 background">
    <div class="trans" style="border-radius: 15px">
        <div class="container mt-2">
            <h4 style="color: white">{{ __('Testimonial Pelanggan Melia Travel') }}</h4>
        </div>
    </div>
</div>
<div class="container mt-3">
    @include('layouts.frontend.components.share')
</div>

<div class="container trans mt-4" style="border-radius: 15px">
    <div class="embed-responsive embed-responsive-16by9">
        <iframe class="pt-3 pr-4 pb-3 pl-4 embed-responsive-item" src="https://www.youtube.com/embed/02L4RVWrdM0?rel=0"
            allowfullscreen></iframe>
    </div>
</div>
<div class="row row-cols-1 row-cols-md-2">
    <div class="col mt-4">
        @include('pages.frontend.components.testimonial', ['img' => 'testi1.jpg',
        'desc' => 'Absolutely wonderful!','credit'=>'Shurwood G' ])
    </div>
    <div class="col mt-4">
        @include('pages.frontend.components.testimonial', ['img' => 'testi1.jpg',
        'desc' => 'I was amazed at the quality of melia sarana transport.
        It\'s incredible.','credit'=>'Barry Q' ])
    </div>
    <div class="col mt-4">
        @include('pages.frontend.components.testimonial', ['img' => 'testi1.jpg',
        'desc' => 'Great job, I will definitely be ordering again! If you
        want real marketing that works and effective implementation - melia sarana transport\'s got you
        covered. Melia sarana transport was worth a fortune to my company. I use melia sarana transport
        often.','credit'=>'Son R' ])
    </div>
    <div class="col mt-4">
        @include('pages.frontend.components.testimonial', ['img' => 'testi1.jpg',
        'desc' => 'Definitely worth the investment.','credit'=>'Matty J' ])
    </div>
</div>
@endsection