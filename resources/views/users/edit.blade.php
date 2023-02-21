<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last mb-2">
                <h3>Users</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">users-update</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>
    
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Update User</h4>
            </div>
            <div class="card-body">
                <x-alert session="updateUser" color="success" />
                <form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <x-maz-input
                                id="name"
                                value="{{ $user->name }}"
                                label="Name"
                                name="name">
                            </x-maz-input>
                            
                            <x-maz-input
                                id="username"
                                value="{{ $user->username }}"
                                label="Username"
                                name="username">
                            </x-maz-input>

                            <x-maz-input
                                id="email"
                                value="{{ $user->email }}"
                                label="Email"
                                type="email"
                                name="email">
                            </x-maz-input>

                            <div class="form-group">
                                <label for="role">Role</label>
                                <select name="role" class="form-control @error('role') is-invalid @enderror" id="exampleFormControlSelect1" required>
                                    <option value="">Select Option</option>
                                    @foreach ($role as $item)
                                        <option {{ $user->roles[0]->id  == $item->id ? "selected" : "" }} value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <x-maz-input-error for="role" />

                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>            
            </div>
        </div>
    </section>
</x-app-layout>

<!-- Modal untuk membuat pengguna baru -->

