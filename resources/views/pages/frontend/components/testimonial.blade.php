<div class="card h-100">
    <img class="card-img-top" src="{{ asset('img') . '/' . $img }}">
    <div class="card-body">
        <blockquote class="blockquote mb-0">
            <p>{{ __('"').$desc.__('"') }}</p>
            <footer class="blockquote-footer">
                <cite title="Source Title">{{ $credit.__('.') }}</cite>
            </footer>
        </blockquote>
    </div>
</div>