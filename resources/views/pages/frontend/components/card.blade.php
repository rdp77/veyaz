<div class="card">
    <img class="card-img-top" src="{{ asset('thumb') . '/' . $img }}">
    <div class="card-body">
        <div class="card-title">
            <h2 class="mt-2">{{ $title }}</h2>
        </div>
        <div class="card-text">
            <p>
                {!! Str::of($desc)->limit(20) !!}
            </p>
        </div>
    </div>
    <a href="{{ $link }}" class="btn btn-dark" style="border-radius: 0 !important;">{{ $btn }}</a>
</div>