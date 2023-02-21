<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last mb-2">
                <h3>Roles</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">roles - update</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>
    
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Update Role</h4>
            </div>
            <div class="card-body">
                <x-alert session="updateRole" color="success" />
                <form action="{{ route('roles.update', ['role' => $role->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <x-maz-input id="name" value="{{ $role->name }}" label="Name" name="name">
                            </x-maz-input>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>            
            </div>
        </div>
    </section>
</x-app-layout>

<!-- Modal untuk membuat pengguna baru -->

