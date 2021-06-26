@if(Session::has('status'))
<div class="alert alert-{{ Session::get('type') }} alert-has-icon">
    <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
    <div class="alert-body">
        <div class="alert-title">{{ __('Informasi') }}</div>
        {{ Session::get('status') }}
    </div>
</div>
@endif