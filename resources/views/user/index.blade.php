<x-app-layout>
    @if(session()->has('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif

    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Kelola User</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Kelola User</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h4 class="card-title">Daftar User</h4>
                    </div>
                    <div class="d-flex">
                        @unless ($trashed)
                        <a href="{{ route('users.recycle') }}" class="btn btn-warning btn-sm ms-2">
                            <i class="bi bi-arrow-clockwise"></i>
                            Arsip
                        </a>
                        <form action="{{ route('users.deleteAll')}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm ms-2">
                                <i class="bi bi-trash"></i>
                                Hapus Semua
                            </button>
                        </form>
                        <a href="{{ route('users.create')}}" class="btn btn-success btn-sm ms-2">
                            <i class="bi bi-plus"></i>
                            Tambah
                        </a>
                        @else
                        <a href="{{ route('users.index') }}" class="btn btn-primary btn-sm ms-2">
                            <i class="bi bi-arrow-clockwise"></i>
                            Data Utama
                        </a>
                        <form action="{{ route('users.restoreAll')}}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-secondary btn-sm ms-2">
                                <i class="bi bi-arrow-clockwise"></i>
                                Kembalikan Semua
                            </button>
                        </form>
                        @endunless
                    </div>
                </div>
            </div>
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </section>

    <x-slot name="script">
        {{ $dataTable->scripts() }}
    </x-slot>
</x-app-layout>