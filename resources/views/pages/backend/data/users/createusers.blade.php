<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Add User</h3>
                <p class="text-subtitle text-muted">Create New User</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Add User</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>

    
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Add User</h4>
            </div>
            <div class="card-body">
                <form method="post" id="user_form" class="form-horizontal">
                    <div class="form-group">
                        <label>Name : </label>
                        <input type="text" name="name" id="name" class="form-control" />
                    </div>
                    <div class="form-group">
                        {!! Form::label('role', 'Role') !!}
                        {!! Form::select('role_id', $roles, null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label>Username : </label>
                        <input type="text" name="username" id="name" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Email : </label>
                        <input type="email" name="email" id="email" class="form-control" />
                    </div>
                    <div class="form-group editpass">
                        <label>Password : </label>
                        <input type="password" name="password" id="password" class="form-control" />
                    </div>
                    <div class="form-group editpass">
                        <label>Confirmation Password : </label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" />
                    </div>
                    <button type="submit" class="btn btn-primary float-end mt-2">Save</button>
                </form>
            </div>
        </div>
    </section>

<script type="text/javascript">
  $(document).ready(function(){
        $('#user_form').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                type: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ route('users.store') }}",
                data: $(this).serialize(),
                dataType: 'json',
                success: function(data) {
                    $('#user_form')[0].reset();
                    swal.fire("Done!", data.data , "success");
                },
                error: function(data) {
                    var errors = data.responseJSON;
                    console.log(errors);
                }
            });
        });
  });
</script>
</x-app-layout>
