<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last mb-2">
                <h3>Roles</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">role-create</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>
    
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Create Role</h4>
            </div>
            <div class="card-body">
                <x-alert session="createRole" color="success" />
                <form action="{{ route('roles.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <x-maz-input id="name" value="{{ old('name') }}" label="Name" name="name">
                            </x-maz-input>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>            
            </div>
        </div>
    </section>
</x-app-layout>

<!-- Modal untuk membuat pengguna baru -->

