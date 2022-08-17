@extends('layouts.backend.default')
@section('title', __('pages.title').__(' | ').__('Pengaturan'))
@section('backToContent')
@include('pages.backend.components.backToContent',['url'=>route('dashboard')])
@endsection
@section('titleContent', __('Pengaturan'))
@section('breadcrumb', __('pages.dashboard'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Pengaturan') }}</div>
@endsection

@section('content')
@include('layouts.backend.components.sectionTitle',[
'title' => null,
'description' => 'Ubah informasi tentang website di halaman ini.',
])
<div class="card card-dark">
    <form method="post">
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-6 col-12">
                    <label class="control-label">Title<code>*</code></label>
                    <input type="text" class="form-control" required>
                </div>
                <div class="form-group col-md-6 col-12">
                    <label class="control-label">Short Title<code>*</code></label>
                    <input type="text" class="form-control" maxlength="3" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-7 col-12">
                    <label>Email</label>
                    <input type="email" class="form-control" value="ujang@maman.com" required="">
                    <div class="invalid-feedback">
                        Please fill in the email
                    </div>
                </div>
                <div class="form-group col-md-5 col-12">
                    <label>Phone</label>
                    <input type="tel" class="form-control" value="">
                </div>
            </div>
            <div class="row">
                <div class="form-group mb-0 col-12">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="remember" class="custom-control-input" id="newsletter">
                        <label class="custom-control-label" for="newsletter">Subscribe to newsletter</label>
                        <div class="text-muted form-text">
                            You will get new information about products, offers and promotions
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <button class="btn btn-primary">Save Changes</button>
        </div>
    </form>
</div>
@endsection