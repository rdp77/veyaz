<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Tambah User</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('users.index')}}">Kelola User</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah User</li>
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
                        <h4 class="card-title">Data User</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('users.store') }}" onsubmit="return store()">
                    @csrf
                    
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="name" class="form-control" name="name" id="name" placeholder="Masukan nama" required>
                        @error('name')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="username" class="form-control" name="username" id="username" placeholder="Masukan username" required>
                        @error('username')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Masukan email" required>
                        @error('email')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Masukan password" required>
                        @error('password')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Password Konfirmasi</label>
                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Masukan konfirmasi password" required>
                        @error('password_confirmation')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </section>
</x-app-layout>