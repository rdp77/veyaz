<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="order-last col-12 col-md-6 order-md-1">
                <h3>Dashboard</h3>
                <p class="text-subtitle text-muted">This is the main page.</p>
            </div>
            <div class="order-first col-12 col-md-6 order-md-2">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>


    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Example Content</h4>
            </div>
            <div class="card-body">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur quas omnis
                laudantium tempore
                exercitationem, expedita aspernatur sed officia asperiores unde tempora maxime odio
                reprehenderit
                distinctio incidunt! Vel aspernatur dicta consequatur!
            </div>
        </div>
        @if (auth()->user()->role_id == 1)
            @include('pages.user.index')
        @endif
    </section>
</x-app-layout>
