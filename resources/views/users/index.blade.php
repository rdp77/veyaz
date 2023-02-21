<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last mb-2">
                <h3>Users</h3>
                <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm ml-auto" data-toggle="modal" data-target="#addUserModal">Add User</a>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">users</li>
                    </ol>
                </nav>
                <x-alert session="deleteUser" color="success" />
            </div>
        </div>
    </x-slot>
    
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">List Users</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="ml-28">
                                                <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="btn btn-sm btn-primary">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                            </div>
                                            <form action="{{ route('users.destroy', ['user' => $user->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger mr-2">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                            <a href="{{ route('users.change-password', ['id' => $user->id]) }}" class="btn btn-sm btn-success ml-28">Change Password</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>               
            </div>
        </div>
    </section>
</x-app-layout>
