@props(['session', 'color'])
@if (session($session))
    <div class="alert alert-{{ $color }}">
        {{ session($session) }}
    </div>
@endif