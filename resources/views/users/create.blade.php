<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last mb-2">
                <h3>Users</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">users-create</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>
    
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Create User</h4>
            </div>
            <div class="card-body">
                <x-alert session="createUser" color="success" />
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <x-maz-input
                                id="name"
                                value="{{ old('name') }}"
                                label="Name"
                                name="name">
                            </x-maz-input>
                            
                            <x-maz-input
                                id="username"
                                value="{{ old('username') }}"
                                label="Username"
                                name="username">
                            </x-maz-input>

                            <x-maz-input
                                id="email"
                                value="{{ old('email') }}"
                                label="Email"
                                type="email"
                                name="email">
                            </x-maz-input>

                            <div class="form-group">
                                <label for="role">Role</label>
                                <select name="role" class="form-control @error('role') is-invalid @enderror" id="exampleFormControlSelect1" required>
                                    <option value="">Select Option</option>
                                    @foreach ($role as $item)
                                        <option {{ old('role') == $item->id ? "selected" : "" }} value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <x-maz-input-error for="role" />
                            </div>

                            <x-maz-input
                                id="password"
                                label="Password"
                                type="password"
                                name="password">
                            </x-maz-input>

                            <div class="form-group">
                                <label for="password_confirmation">Verify Password</label>
                                <input type="password" name="password_confirmation" class="form-control @error('password') is-invalid @enderror" required>
                                <x-maz-input-error for="password" />
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>            
            </div>
        </div>
    </section>
</x-app-layout>

<!-- Modal untuk membuat pengguna baru -->

