<h2 class="section-title">
    {{ $title ?? __('Hi, '.Auth::user()->name.'!' ) }}
</h2>
<p class="section-lead">
    {{ $description }}
</p>